@extends('layouts.public')

@section('content')
<x-public.breadcrumb :items="[
    ['label' => 'Home', 'url' => route('public.homepage')],
    ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
    ['label' => $bootcamp->title, 'url' => route('public.bootcamp', $bootcamp->slug)],
    ['label' => 'Enroll', 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$bootcamp->title"
    titleLine2="Enrollment"
    description="Choose your preferred cohort and secure your seat. Spots are limited and fill quickly each intake."
    :stats="[
        ['label' => 'Program level', 'value' => ucfirst($bootcamp->level)],
        ['label' => 'Duration', 'value' => $bootcamp->duration_hours . ' hours'],
        ['label' => 'Tuition', 'value' => 'Rp ' . number_format($bootcamp->base_price, 0, ',', '.')]
    ]"
/>

<div class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(99,102,241,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-[30px] p-8">
            <span class="spotlight-ring"></span>
            <h2 class="text-lg font-semibold text-white">Select a Cohort</h2>
            <p class="mt-2 text-sm text-slate-300">Pick the batch that fits your schedule. Each cohort includes live sessions, mentor support, and career coaching.</p>

            <form action="{{ route('payment.process', $bootcamp->slug) }}" method="POST" class="mt-10 space-y-10">
                @csrf

                @if($batches->isEmpty())
                    <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-8 text-center text-sm text-slate-400">
                        No cohorts are open at the moment. Join the waitlist or message our admissions team for upcoming dates.
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        @foreach($batches as $batch)
                            <label for="batch_{{ $batch->id }}" class="relative block cursor-pointer">
                                <input type="radio" name="batch_id" value="{{ $batch->id }}" id="batch_{{ $batch->id }}" class="peer sr-only" required>
                                <div class="glass-card rounded-3xl p-6 transition hover:shadow-[0_20px_45px_-25px_rgba(56,189,248,0.7)] peer-checked:border-sky-400/50">
                                    <span class="spotlight-ring"></span>
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h3 class="text-base font-semibold text-white">Batch {{ $batch->code }}</h3>
                                            <p class="mt-1 text-xs text-slate-400">{{ $batch->start_date->format('M d, Y') }} — {{ $batch->end_date->format('M d, Y') }}</p>
                                        </div>
                                        <span class="inline-flex items-center rounded-full border border-sky-400/40 bg-sky-500/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] text-sky-200">
                                            {{ ucfirst($batch->status) }}
                                        </span>
                                    </div>
                                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $batch->city->name ?? 'Online' }}</span>
                                    </div>
                                    <div class="mt-5 flex items-center justify-between text-sm">
                                        <span class="text-slate-400">{{ $batch->available_slots }} slots available</span>
                                        <span class="text-base font-semibold text-white">Rp {{ number_format($bootcamp->base_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('batch_id')
                        <p class="text-sm text-rose-400">{{ $message }}</p>
                    @enderror
                @endif

                @if(!$batches->isEmpty())
                    <div class="glass-card rounded-3xl p-6">
                        <span class="spotlight-ring"></span>
                        <div class="flex items-start gap-3">
                            <input id="terms" name="terms" type="checkbox" class="mt-1 h-4 w-4 rounded border-white/20 bg-transparent text-sky-300 focus:ring-sky-400" required>
                            <div class="text-sm text-slate-300">
                                <label for="terms" class="font-semibold text-white">I agree to the terms and conditions</label>
                                <p class="mt-1 text-xs text-slate-400">
                                    By enrolling, you agree to our <a href="#" class="text-sky-300 hover:text-sky-200">Terms of Service</a> and <a href="#" class="text-sky-300 hover:text-sky-200">Privacy Policy</a>.
                                </p>
                                @error('terms')
                                    <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-public.button type="submit" class="px-8 py-3 text-sm">
                            Proceed to Payment
                        </x-public.button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
