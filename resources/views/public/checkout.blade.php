@extends('layouts.public')

@section('content')
@php
    $order = $order ?? null;
    $bootcampTitle = optional($order?->enrollment?->batch?->bootcamp)->title ?? 'Bootcamp Program';
    $batchCode = optional($order?->enrollment?->batch)->code ?? 'BATCH-001';
    $startDate = optional($order?->enrollment?->batch?->start_date)->format('M d, Y');
    $endDate = optional($order?->enrollment?->batch?->end_date)->format('M d, Y');
@endphp

<x-public.breadcrumb :items="[
    ['label' => 'Home', 'url' => route('public.homepage')],
    ['label' => 'Dashboard', 'url' => route('public.dashboard')],
    ['label' => 'Checkout', 'url' => '#']
]" />

<x-public.hero-section 
    titleLine1="Secure Your Seat"
    titleLine2="Complete Your Enrollment"
    description="Review the order summary and complete payment to lock in your cohort placement."
    :stats="[
        ['label' => 'Order total', 'value' => 'Rp ' . number_format($order->total, 0, ',', '.')],
        ['label' => 'Invoice', 'value' => $order->invoice_no],
        ['label' => 'Expires', 'value' => optional($order->expired_at)->format('d M, H:i') ?? '—']
    ]"
/>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <article class="glass-card rounded-[28px] p-6">
                <span class="spotlight-ring"></span>
                <h2 class="text-lg font-semibold text-white">Order Summary</h2>
                <div class="mt-6 space-y-5 text-sm text-slate-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-white">{{ $bootcampTitle }}</p>
                            <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Batch {{ $batchCode }}</p>
                            <p class="mt-2 text-xs text-slate-400">{{ $startDate }} @if($endDate) — {{ $endDate }} @endif</p>
                        </div>
                        <p class="text-base font-semibold text-white">Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                    </div>

                    @if($order->discount_amount > 0)
                        <div class="flex items-center justify-between border-t border-white/5 pt-4 text-xs text-slate-400">
                            <span>Discount</span>
                            <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between border-t border-white/5 pt-4">
                        <span class="text-sm font-semibold text-slate-300">Total</span>
                        <span class="text-xl font-semibold text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-6 rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-xs text-slate-400">
                    <p><span class="text-slate-200">Order ID:</span> {{ $order->invoice_no }}</p>
                    <p class="mt-2"><span class="text-slate-200">Expires:</span> {{ optional($order->expired_at)->format('d M Y H:i') ?? '—' }}</p>
                </div>
            </article>

            <article class="glass-card flex h-full flex-col justify-between rounded-[28px] p-6">
                <span class="spotlight-ring"></span>
                <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full border border-sky-400/40 bg-sky-500/10 text-sky-200">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-white">Midtrans Secure Payment</h3>
                    <p class="mt-3 text-sm text-slate-300">You will be redirected to our secure payment gateway to complete your purchase.</p>
                    <button id="pay-button" class="mt-8 w-full rounded-full border border-sky-400/40 bg-gradient-to-r from-sky-400 to-indigo-500 py-3 text-sm font-semibold text-white transition hover:shadow-[0_18px_35px_-18px_rgba(56,189,248,0.7)] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-sky-400">
                        Pay Rp {{ number_format($order->total, 0, ',', '.') }}
                    </button>
                </div>
                <div class="mt-8 flex items-center justify-center gap-6 border-t border-white/5 pt-6 text-xs text-slate-400">
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Secure checkout
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Encrypted data
                    </span>
                </div>
            </article>
        </div>
    </div>
</section>

<script src="{{ $snapJsUrl }}" data-client-key="{{ $clientKey }}"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var payButton = document.getElementById('pay-button');
        if (!payButton) {
            console.error('Pay button not found');
            return;
        }

        var snapToken = '{{ $snapToken }}';
        if (!snapToken || snapToken === '') {
            payButton.disabled = true;
            payButton.textContent = 'Payment Unavailable';
            payButton.classList.add('opacity-60', 'cursor-not-allowed');
            alert('Payment initialization failed. Please contact support.');
            return;
        }

        payButton.onclick = function() {
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    window.location.href = '{{ route("payment.success.redirect") }}?order_id=' + result.order_id + '&status_code=' + result.status_code + '&transaction_status=' + result.transaction_status;
                },
                onPending: function(result) {
                    window.location.href = '{{ route("payment.success.redirect") }}?order_id=' + result.order_id + '&status_code=' + result.status_code + '&transaction_status=' + result.transaction_status;
                },
                onError: function() {
                    window.location.href = '{{ route("payment.failure") }}';
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment. If you have completed the payment, please wait for confirmation.');
                }
            });
        };
    });
</script>
@endsection
