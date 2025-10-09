@extends('layouts.public')

@section('content')
<x-public.hero-section 
    titleLine1="Payment Confirmed"
    titleLine2="You're officially enrolled"
    description="We've received your payment and locked in your seat. A confirmation email has been sent to your inbox."
    :stats="[
        ['label' => 'Order ID', 'value' => $order->invoice_no],
        ['label' => 'Total Paid', 'value' => 'Rp ' . number_format($order->total, 0, ',', '.')],
        ['label' => 'Status', 'value' => 'Paid']
    ]"
/>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <article class="glass-card rounded-[30px] p-8">
            <span class="spotlight-ring"></span>
            <div class="flex flex-col items-center text-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full border border-emerald-400/40 bg-emerald-500/10 text-emerald-200">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="mt-6 text-sm text-slate-300">{{ optional($order->enrollment->user)->email ?? 'Email on file' }}</p>
            </div>

            <div class="mt-10 space-y-5 text-sm text-slate-300">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="text-left">
                        <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Program</p>
                        <p class="mt-2 text-base font-semibold text-white">{{ $order->enrollment->batch->bootcamp->title }}</p>
                        <p class="mt-1 text-xs text-slate-400">Batch {{ $order->enrollment->batch->code }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $order->enrollment->batch->start_date->format('M d, Y') }} — {{ $order->enrollment->batch->end_date->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Total Paid</p>
                        <p class="mt-2 text-lg font-semibold text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 border-t border-white/5 pt-5 text-xs text-slate-400 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                        <span class="text-slate-200">Payment Reference</span>
                        <p class="mt-2 font-semibold text-white">{{ $order->invoice_no }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                        <span class="text-slate-200">Status</span>
                        <p class="mt-2 inline-flex items-center rounded-full border border-emerald-400/40 bg-emerald-500/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] text-emerald-200">Paid</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center">
                <x-public.button href="{{ route('public.dashboard') }}" class="px-6 py-3 text-sm">
                    Go to Dashboard
                </x-public.button>
                <x-public.button href="{{ route('public.bootcamp', $order->enrollment->batch->bootcamp->slug) }}" variant="secondary" class="px-6 py-3 text-sm">
                    View Bootcamp Details
                </x-public.button>
            </div>
        </article>
    </div>
</section>
@endsection
