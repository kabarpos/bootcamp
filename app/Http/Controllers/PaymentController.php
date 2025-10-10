<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\ProcessEnrollmentRequest;
use App\Models\Bootcamp;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Payment;
use App\Services\MidtransService;
use App\Services\WhatsappNotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $midtransService;
    protected $whatsappService;

    public function __construct(MidtransService $midtransService, WhatsappNotificationService $whatsappService)
    {
        $this->midtransService = $midtransService;
        $this->whatsappService = $whatsappService;
    }

    /**
     * Show enrollment form for a bootcamp
     */
    public function enroll($slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $batches = $bootcamp->activeBatches()->with('city')->get();

        return view('public.enroll', compact('bootcamp', 'batches'));
    }

    /**
     * Process enrollment and create order
     */
    public function processEnrollment(ProcessEnrollmentRequest $request, $slug)
    {
        $validated = $request->validated();

        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $order = DB::transaction(function () use ($validated, $bootcamp) {
            $batch = Batch::whereKey($validated['batch_id'])
                ->where('bootcamp_id', $bootcamp->id)
                ->lockForUpdate()
                ->first();

            if (! $batch) {
                return null;
            }

            $userId = Auth::id();

            $existingEnrollment = Enrollment::where('user_id', $userId)
                ->where('batch_id', $batch->id)
                ->lockForUpdate()
                ->first();

            if ($existingEnrollment) {
                return 'existing';
            }

            $activeEnrollments = $batch->enrollments()
                ->active()
                ->lockForUpdate()
                ->count();

            if ($batch->capacity !== null && $batch->capacity > 0 && $activeEnrollments >= $batch->capacity) {
                return 'full';
            }

            $enrollment = Enrollment::create([
                'user_id' => $userId,
                'batch_id' => $batch->id,
                'status' => 'pending',
            ]);

            do {
                $invoiceNo = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            } while (Order::where('invoice_no', $invoiceNo)->exists());

            return Order::create([
                'enrollment_id' => $enrollment->id,
                'invoice_no' => $invoiceNo,
                'amount' => $bootcamp->base_price,
                'discount_amount' => 0,
                'total' => $bootcamp->base_price,
                'status' => 'pending',
                'expired_at' => now()->addDays(7),
            ]);
        });

        if ($order === null) {
            return redirect()->back()->with('error', 'Invalid batch selection.');
        }

        if ($order === 'existing') {
            return redirect()->back()->with('error', 'You are already enrolled in this batch.');
        }

        if ($order === 'full') {
            return redirect()->back()->with('error', 'This batch is full.');
        }

        $this->notifyOrderCreated($order);

        return redirect()->route('payment.checkout', $order->id);
    }

    /**
     * Show checkout page with Midtrans payment
     */
    public function checkout($orderId)
    {
        $order = Order::with(['enrollment.batch.bootcamp', 'enrollment.user'])
            ->findOrFail($orderId);

        if ($order->enrollment->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->route('public.dashboard')->with('error', 'This order is no longer valid.');
        }

        if ($order->expired_at && $order->expired_at < now()) {
            return redirect()->route('public.dashboard')->with('error', 'This order has expired.');
        }

        $transactionDetails = [
            'order_id' => $order->invoice_no,
            'gross_amount' => (int) round((float) $order->total),
        ];

        $snapToken = $this->midtransService->getSnapToken($transactionDetails);

        if (! $snapToken) {
            Log::error('Failed to get Snap token for order', [
                'order_id' => $order->id,
                'invoice_no' => $order->invoice_no,
                'user_id' => Auth::id(),
                'transaction_details' => $transactionDetails,
            ]);

            return redirect()->route('public.dashboard')->with('error', 'Failed to initialize payment. Please try again.');
        }

        $snapJsUrl = $this->midtransService->getSnapJsUrl();
        $clientKey = $this->midtransService->getClientKey();

        return view('public.checkout', compact('order', 'snapToken', 'snapJsUrl', 'clientKey'));
    }

    /**
     * Handle Midtrans notification (webhook)
     */
    public function notification(Request $request)
    {
        $notification = $request->all();

        Log::info('Midtrans notification received', [
            'order_id' => $notification['order_id'] ?? null,
            'transaction_status' => $notification['transaction_status'] ?? null,
        ]);

        if (! $this->midtransService->validateSignature($notification)) {
            Log::warning('Midtrans notification signature mismatch', [
                'order_id' => $notification['order_id'] ?? null,
            ]);

            return response()->json(['status' => 'INVALID_SIGNATURE'], 403);
        }

        $result = $this->midtransService->handleNotification($notification);

        Log::debug('Midtrans notification processed', [
            'order_id' => $result['order_id'] ?? null,
            'status' => $result['status'] ?? null,
        ]);

        $order = Order::where('invoice_no', $result['order_id'])->first();

        if (! $order) {
            Log::warning('Order not found for notification', ['order_id' => $result['order_id']]);

            return response()->json(['status' => 'IGNORED']);
        }

        Log::info('Order found for notification', [
            'order_id' => $order->id,
            'invoice_no' => $order->invoice_no,
            'old_status' => $order->status,
            'new_status' => $result['status'],
        ]);

        $this->applyPaymentStatus($order, $result, $notification);

        return response()->json(['status' => 'OK']);
    }

    /**
     * Handle payment success redirect
     */
    public function success(Request $request)
    {
        Log::info('Payment success redirect called', [
            'order_id' => $request->get('order_id'),
            'status_code' => $request->get('status_code'),
            'transaction_status' => $request->get('transaction_status'),
        ]);

        $orderId = $request->get('order_id');

        if ($orderId) {
            $order = Order::where('invoice_no', $orderId)->first();

            if ($order) {
                if ($order->enrollment->user_id !== Auth::id()) {
                    Log::warning('Unauthorized payment redirect access attempt', [
                        'order_id' => $orderId,
                        'actor_id' => Auth::id(),
                    ]);
                    abort(403);
                }

                if ($order->status === 'paid') {
                    Log::info('Redirecting to payment success page', ['order_id' => $order->id]);
                    return redirect()->route('payment.success', $order->id);
                }

                $statusResponse = $this->midtransService->getTransactionStatus($orderId);

                if ($statusResponse) {
                    $result = $this->midtransService->handleNotification($statusResponse);

                    $this->applyPaymentStatus($order, $result, $statusResponse);
                    $order->refresh();

                    if ($result['status'] === 'paid') {
                        Log::info('Payment synchronized during success redirect', [
                            'order_id' => $order->id,
                            'status' => $order->status,
                        ]);

                        return redirect()->route('payment.success', $order->id);
                    }

                    if (in_array($result['status'], ['failed', 'expired', 'refunded'], true)) {
                        Log::info('Payment not successful after status sync', [
                            'order_id' => $order->id,
                            'synced_status' => $result['status'],
                        ]);

                        return redirect()->route('payment.failure')->with('error', 'Payment was not completed.');
                    }
                } else {
                    Log::warning('Unable to fetch Midtrans status during success redirect', [
                        'order_id' => $order->id,
                    ]);
                }
            }
        }

        Log::info('Redirecting to dashboard with info message');
        return redirect()->route('public.dashboard')->with('info', 'Payment status is being processed.');
    }

    /**
     * Show payment success page
     */
    public function successPage($orderId)
    {
        $order = Order::with(['enrollment.batch.bootcamp', 'enrollment.user'])
            ->findOrFail($orderId);

        if ($order->enrollment->user_id !== Auth::id()) {
            abort(403);
        }

        return view('public.payment-success', compact('order'));
    }

    /**
     * Show payment failure page
     */
    public function failure()
    {
        return view('public.payment-failure');
    }

    private function applyPaymentStatus(Order $order, array $result, array $payload = []): void
    {
        $existingPayment = $order->payments()->latest()->first();
        $paymentType = $payload['payment_type'] ?? null;
        $mappedMethod = $paymentType
            ? $this->mapPaymentMethod($paymentType)
            : ($existingPayment?->method ?? 'manual');

        $order->update(['status' => $result['status']]);

        if ($result['status'] === 'paid') {
            $order->enrollment->update(['status' => 'confirmed']);

            $paidAt = $existingPayment?->paid_at;

            try {
                if (! empty($payload['settlement_time'])) {
                    $paidAt = Carbon::parse($payload['settlement_time']);
                } elseif (! empty($payload['transaction_time'])) {
                    $paidAt = Carbon::parse($payload['transaction_time']);
                } elseif (! $paidAt) {
                    $paidAt = now();
                }
            } catch (\Exception $exception) {
                Log::warning('Failed to parse Midtrans payment timestamp', [
                    'order_id' => $order->id,
                    'payload_time' => $payload['settlement_time'] ?? $payload['transaction_time'] ?? null,
                    'message' => $exception->getMessage(),
                ]);

                $paidAt = now();
            }
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'method' => $mappedMethod,
                    'provider' => 'midtrans',
                    'transaction_id' => $payload['transaction_id'] ?? $existingPayment?->transaction_id,
                    'status' => 'success',
                    'paid_at' => $paidAt,
                    'receipt_url' => $payload['pdf_url'] ?? $existingPayment?->receipt_url,
                    'va_number' => data_get($payload, 'va_numbers.0.va_number', $existingPayment?->va_number),
                    'ewallet_ref' => $payload['issuer'] ?? $payload['payment_type'] ?? $existingPayment?->ewallet_ref,
                ]
            );

            Log::info('Payment recorded or updated for order', ['order_id' => $order->id]);
            $this->notifyPaymentSuccess($order);
        } elseif ($result['status'] === 'expired') {
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'method' => $mappedMethod,
                    'provider' => $existingPayment?->provider ?? 'midtrans',
                    'transaction_id' => $payload['transaction_id'] ?? $existingPayment?->transaction_id,
                    'status' => 'failed',
                    'paid_at' => null,
                    'receipt_url' => $existingPayment?->receipt_url,
                    'va_number' => $existingPayment?->va_number,
                    'ewallet_ref' => $existingPayment?->ewallet_ref,
                ]
            );

            $order->enrollment->update(['status' => 'pending']);
            $this->notifyPaymentFailed($order);
        } elseif ($result['status'] === 'refunded') {
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'method' => $mappedMethod,
                    'provider' => $existingPayment?->provider ?? 'midtrans',
                    'transaction_id' => $payload['transaction_id'] ?? $existingPayment?->transaction_id,
                    'status' => 'refunded',
                    'paid_at' => null,
                    'receipt_url' => $existingPayment?->receipt_url,
                    'va_number' => $existingPayment?->va_number,
                    'ewallet_ref' => $existingPayment?->ewallet_ref,
                ]
            );

            $order->enrollment->update(['status' => 'cancelled']);
            $this->notifyPaymentFailed($order);
        } elseif ($result['status'] === 'failed') {
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'method' => $mappedMethod,
                    'provider' => $existingPayment?->provider ?? 'midtrans',
                    'transaction_id' => $payload['transaction_id'] ?? $existingPayment?->transaction_id,
                    'status' => 'failed',
                    'paid_at' => null,
                    'receipt_url' => $existingPayment?->receipt_url,
                    'va_number' => $existingPayment?->va_number,
                    'ewallet_ref' => $existingPayment?->ewallet_ref,
                ]
            );
            $this->notifyPaymentFailed($order);
        }
    }

    private function mapPaymentMethod(?string $raw): string
    {
        return match ($raw) {
            'bank_transfer', 'echannel', 'permata' => 'va',
            'qris' => 'qris',
            'gopay', 'shopeepay', 'ovo' => 'ewallet',
            'credit_card' => 'cc',
            default => 'manual',
        };
    }

    protected function notifyOrderCreated(Order $order): void
    {
        $user = $order->enrollment->user;

        if (! $user || ! $user->whatsapp_number) {
            return;
        }

        $this->whatsappService->sendTemplate('order_created', $user->whatsapp_number, [
            'name' => $user->name,
            'invoice_no' => $order->invoice_no,
            'bootcamp_title' => optional($order->enrollment->batch->bootcamp)->title,
            'amount' => number_format((float) $order->total, 0, ',', '.'),
            'expires_at' => optional($order->expired_at)->format('d M Y H:i') ?? '-',
            'app_name' => config('app.name'),
        ]);
    }

    protected function notifyPaymentSuccess(Order $order): void
    {
        $user = $order->enrollment->user;

        if (! $user || ! $user->whatsapp_number) {
            return;
        }

        $this->whatsappService->sendTemplate('payment_success', $user->whatsapp_number, [
            'name' => $user->name,
            'invoice_no' => $order->invoice_no,
            'enrollment_status' => ucfirst($order->enrollment->status),
            'bootcamp_title' => optional($order->enrollment->batch->bootcamp)->title,
            'app_name' => config('app.name'),
        ]);
    }

    protected function notifyPaymentFailed(Order $order): void
    {
        $user = $order->enrollment->user;

        if (! $user || ! $user->whatsapp_number) {
            return;
        }

        $this->whatsappService->sendTemplate('payment_failed', $user->whatsapp_number, [
            'name' => $user->name,
            'invoice_no' => $order->invoice_no,
            'checkout_url' => route('payment.checkout', $order->id),
            'app_name' => config('app.name'),
        ]);
    }
}

