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
    public function processEnrollment(Request $request, $slug)
    {
        $request->validate([
            'batch_id' => 'required|exists:batch,id',
            'terms' => 'accepted',
        ]);

        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $batch = Batch::findOrFail($request->batch_id);

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

        // Create order
        $invoiceNo = 'INV-' . date('Ymd') . '-' . str_pad(Order::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
        
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

        // Check if order belongs to current user
        if ($order->enrollment->user_id != Auth::id()) {
            abort(403);
        }

        // Check if order is still pending
        if ($order->status != 'pending') {
            return redirect()->route('public.dashboard')->with('error', 'This order is no longer valid.');
        }

        // Check if order is expired
        if ($order->expired_at && $order->expired_at < now()) {
            return redirect()->route('public.dashboard')->with('error', 'This order has expired.');
        }

        // Prepare transaction details for Midtrans
        // Convert to integer for IDR currency (remove decimals)
        $transactionDetails = [
            'order_id' => $order->invoice_no,
            'gross_amount' => (int) round($order->total), // Convert to integer
        ];

        // Get Snap token from Midtrans
        $snapToken = $this->midtransService->getSnapToken($transactionDetails);

        // Log if snap token is null
        if (!$snapToken) {
            Log::error('Failed to get Snap token for order', [
                'order_id' => $order->id,
                'invoice_no' => $order->invoice_no,
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('public.dashboard')->with('error', 'Failed to initialize payment. Please try again.');
        }

        return view('public.checkout', compact('order', 'snapToken'));
    }

    /**
     * Handle Midtrans notification (webhook)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {
        $notification = $request->all();
        
        Log::info('Midtrans Notification Received', $notification);

        // Handle the notification
        $result = $this->midtransService->handleNotification($notification);
        
        Log::info('Midtrans Notification Processed', $result);
        
        // Find order by invoice number
        $order = Order::where('invoice_no', $result['order_id'])->first();
        
        if ($order) {
            Log::info('Order found for notification', [
                'order_id' => $order->id,
                'invoice_no' => $order->invoice_no,
                'old_status' => $order->status,
                'new_status' => $result['status'],
            ]);
            
            // Update order status
            $order->update(['status' => $result['status']]);
            
            // If payment is successful, update enrollment status
            if ($result['status'] === 'paid') {
                $order->enrollment->update(['status' => 'confirmed']);
                
                // Create payment record
                Payment::create([
                    'order_id' => $order->id,
                    'method' => 'va', // Default to VA, can be updated based on payment details
                    'provider' => 'midtrans',
                    'transaction_id' => $notification['transaction_id'] ?? null,
                    'status' => 'success',
                    'paid_at' => now(),
                ]);
                
                Log::info('Payment recorded for order', ['order_id' => $order->id]);
            }
        } else {
            Log::warning('Order not found for notification', ['order_id' => $result['order_id']]);
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