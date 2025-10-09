@extends('layouts.public')

@section('content')
<x-public.hero-section 
    titleLine1="Payment Pending"
    titleLine2="Action Required"
    description="We could not confirm the transaction. Please retry your payment or contact support if you believe this is an error."
    :stats="[
        ['label' => 'Order ID', 'value' => $order->invoice_no ?? '—'],
        ['label' => 'Amount due', 'value' => isset($order) ? 'Rp ' . number_format($order->total, 0, ',', '.') : '—'],
        ['label' => 'Status', 'value' => 'Pending']
    ]"
/>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(239,68,68,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <article class="glass-card rounded-[28px] p-8">
            <span class="spotlight-ring"></span>
            <div class="flex flex-col items-center text-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full border border-rose-400/40 bg-rose-500/10 text-rose-200">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h2 class="mt-6 text-lg font-semibold text-white">Payment not completed</h2>
                <p class="mt-3 text-sm text-slate-300">
                    Your payment was not processed. You can retry completing the purchase or reach out to our team for assistance.
                </p>
            </div>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center">
                <x-public.button href="{{ route('payment.checkout', $order->id ?? null) }}" class="px-6 py-3 text-sm">
                    Retry Payment
                </x-public.button>
                <x-public.button href="{{ route('public.contact') }}" variant="secondary" class="px-6 py-3 text-sm">
                    Contact Support
                </x-public.button>
            </div>
        </article>
    </div>
</section>
@endsection
