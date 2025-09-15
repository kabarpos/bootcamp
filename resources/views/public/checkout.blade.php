@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Dashboard', 'url' => route('public.dashboard')],
        ['label' => 'Checkout', 'url' => '#']
    ]" />
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-foreground sm:text-4xl">
                Complete Your Payment
            </h1>
            <p class="mt-3 text-lg text-muted-foreground">
                You're almost there! Complete your payment to secure your spot.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-card rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-foreground mb-4">Order Summary</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium">{{ $order->enrollment->batch->bootcamp->title }}</p>
                            <p class="text-sm text-muted-foreground">
                                Batch: {{ $order->enrollment->batch->code }}
                            </p>
                            <p class="text-sm text-muted-foreground">
                                {{ $order->enrollment->batch->start_date->format('M d, Y') }} - {{ $order->enrollment->batch->end_date->format('M d, Y') }}
                            </p>
                        </div>
                        <p class="font-medium">
                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                        </p>
                    </div>
                    
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between border-t border-border pt-4">
                            <p class="text-muted-foreground">Discount</p>
                            <p class="text-muted-foreground">
                                - Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    @endif
                    
                    <div class="flex justify-between border-t border-border pt-4">
                        <p class="font-medium">Total</p>
                        <p class="font-bold text-lg">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-primary/5 rounded-lg">
                    <p class="text-sm text-muted-foreground">
                        <strong>Order ID:</strong> {{ $order->invoice_no }}
                    </p>
                    <p class="text-sm text-muted-foreground mt-1">
                        <strong>Expires:</strong> {{ $order->expired_at->format('M d, Y H:i') }}
                    </p>
                </div>
            </div>
            
            <div class="bg-card rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-foreground mb-4">Payment Method</h2>
                
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 mb-4">
                        <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-foreground mb-2">Secure Payment</h3>
                    <p class="text-muted-foreground mb-6">
                        You will be redirected to our secure payment gateway to complete your purchase.
                    </p>
                    
                    <button id="pay-button" class="w-full bg-primary hover:bg-primary/90 text-primary-foreground py-3 px-4 rounded-lg font-medium transition-colors">
                        Pay Rp {{ number_format($order->total, 0, ',', '.') }}
                    </button>
                </div>
                
                <div class="mt-6 pt-6 border-t border-border">
                    <div class="flex items-center justify-center space-x-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="ml-2 text-sm text-muted-foreground">Secure</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="ml-2 text-sm text-muted-foreground">Encrypted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var payButton = document.getElementById('pay-button');
        if (payButton) {
            // Check if snap token is available
            var snapToken = '{{ $snapToken }}';
            if (!snapToken || snapToken === '') {
                payButton.disabled = true;
                payButton.textContent = 'Payment Unavailable';
                payButton.classList.add('bg-gray-400', 'hover:bg-gray-400');
                alert('Payment initialization failed. Please contact support.');
                return;
            }
            
            payButton.onclick = function(){
                // Trigger snap popup. @snap_token_id = SNAP_TOKEN from backend
                snap.pay(snapToken, {
                    onSuccess: function(result){
                        console.log('Payment success:', result);
                        window.location.href = '{{ route("payment.success.redirect") }}?order_id=' + result.order_id + '&status_code=' + result.status_code + '&transaction_status=' + result.transaction_status;
                    },
                    onPending: function(result){
                        console.log('Payment pending:', result);
                        window.location.href = '{{ route("payment.success.redirect") }}?order_id=' + result.order_id + '&status_code=' + result.status_code + '&transaction_status=' + result.transaction_status;
                    },
                    onError: function(result){
                        console.log('Payment error:', result);
                        window.location.href = '{{ route("payment.failure") }}';
                    },
                    onClose: function(){
                        console.log('Payment popup closed');
                        alert('You closed the popup without finishing the payment. If you have completed the payment, please wait for confirmation.');
                    }
                });
            };
        } else {
            console.error('Pay button not found');
        }
    });
</script>
@endsection