<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Payment;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Show enrollment form for a bootcamp
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function enroll($slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get active batches for this bootcamp
        $batches = $bootcamp->activeBatches()->with('city')->get();

        return view('public.enroll', compact('bootcamp', 'batches'));
    }

    /**
     * Process enrollment and create order
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processEnrollment(ProcessEnrollmentRequest $request, $slug)
    {
        $request->validate([
            'batch_id' => 'required|exists:batch,id',
            'terms' => 'accepted',
        ]);

        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $batch = Batch::findOrFail($validated['batch_id']);

        // Check if batch belongs to this bootcamp
        if ($batch->bootcamp_id != $bootcamp->id) {
            return redirect()->back()->with('error', 'Invalid batch selection.');
        }

        // Check if batch has available slots
        if ($batch->available_slots <= 0) {
            return redirect()->back()->with('error', 'This batch is full.');
        }

        // Check if user is already enrolled in this batch
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('batch_id', $batch->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this batch.');
        }

        // Create enrollment
        $enrollment = Enrollment::create([
            'user_id' => Auth::id(),
            'batch_id' => $batch->id,
            'status' => 'pending',
        ]);

        // Create a unique invoice number
        $invoiceNo = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        
        // Ensure the invoice number is unique
        while (Order::where('invoice_no', $invoiceNo)->exists()) {
            $invoiceNo = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        }
        
        $order = Order::create([
            'enrollment_id' => $enrollment->id,
            'invoice_no' => $invoiceNo,
            'amount' => $bootcamp->base_price,
            'discount_amount' => 0,
            'total' => $bootcamp->base_price,
            'status' => 'pending',
            'expired_at' => now()->addDays(7), // Default 7 days
        ]);

        return redirect()->route('payment.checkout', $order->id);
    }

    /**
     * Show checkout page with Midtrans payment
     *
     * @param int $orderId
     * @return \Illuminate\View\View
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

        if (!$snapToken) {
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

        Log::info('Midtrans Notification Received', $notification);

        $result = $this->midtransService->handleNotification($notification);

        Log::info('Midtrans Notification Processed', $result);

        $order = Order::where('invoice_no', $result['order_id'])->first();

        if (!$order) {
            Log::warning('Order not found for notification', ['order_id' => $result['order_id']]);

            return response()->json(['status' => 'IGNORED']);
        }

        Log::info('Order found for notification', [
            'order_id' => $order->id,
            'invoice_no' => $order->invoice_no,
            'old_status' => $order->status,
            'new_status' => $result['status'],
        ]);

        $order->update(['status' => $result['status']]);

        if ($result['status'] === 'paid') {
            $order->enrollment->update(['status' => 'confirmed']);

            $rawMethod = $notification['payment_type'] ?? ($notification['payment_method'] ?? null);
            $method = match ($rawMethod) {
                'bank_transfer', 'echannel', 'permata' => 'va',
                'qris' => 'qris',
                'gopay', 'shopeepay', 'ovo' => 'ewallet',
                'credit_card' => 'cc',
                default => 'manual',
            };

            $paymentData = [
                'method' => $method,
                'provider' => 'midtrans',
                'transaction_id' => $notification['transaction_id'] ?? null,
                'status' => 'success',
                'paid_at' => now(),
                'receipt_url' => $notification['pdf_url'] ?? null,
            ];

            if (!empty($notification['va_numbers'][0]['va_number'])) {
                $paymentData['va_number'] = $notification['va_numbers'][0]['va_number'];
            }

            if (!empty($notification['issuer'])) {
                $paymentData['ewallet_ref'] = $notification['issuer'];
            }

            Payment::updateOrCreate(
                ['order_id' => $order->id],
                $paymentData
            );

            Log::info('Payment recorded for order', ['order_id' => $order->id]);
        } elseif (in_array($result['status'], ['failed', 'expired'], true)) {
            $order->enrollment->update(['status' => 'pending']);

            Payment::where('order_id', $order->id)->update([
                'status' => 'failed',
                'paid_at' => null,
            ]);
        } elseif ($result['status'] === 'refunded') {
            $order->enrollment->update(['status' => 'cancelled']);

            Payment::where('order_id', $order->id)->update([
                'status' => 'refunded',
                'paid_at' => null,
            ]);
        }

        return response()->json(['status' => 'OK']);
    }
    /**
     * Handle payment success redirect
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success(Request $request)
    {
        Log::info('Payment success redirect called', [
            'all_params' => $request->all(),
            'order_id' => $request->get('order_id'),
            'status_code' => $request->get('status_code'),
            'transaction_status' => $request->get('transaction_status'),
        ]);
        
        $orderId = $request->get('order_id');
        
        if ($orderId) {
            $order = Order::where('invoice_no', $orderId)->first();
            
            if ($order && $order->status === 'paid') {
                Log::info('Redirecting to payment success page', ['order_id' => $order->id]);
                return redirect()->route('payment.success', $order->id);
            }
        }
        
        Log::info('Redirecting to dashboard with info message');
        return redirect()->route('public.dashboard')->with('info', 'Payment status is being processed.');
    }

    /**
     * Show payment success page
     *
     * @param int $orderId
     * @return \Illuminate\View\View
     */
    public function successPage($orderId)
    {
        $order = Order::with(['enrollment.batch.bootcamp', 'enrollment.user'])
            ->findOrFail($orderId);

        // Check if order belongs to current user
        if ($order->enrollment->user_id != Auth::id()) {
            abort(403);
        }

        return view('public.payment-success', compact('order'));
    }

    /**
     * Show payment failure page
     *
     * @return \Illuminate\View\View
     */
    public function failure()
    {
        return view('public.payment-failure');
    }
}












