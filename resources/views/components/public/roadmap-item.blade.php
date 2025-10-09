@php
    $status = $status ?? 'upcoming';
    $badgeClasses = match($status) {
        'completed' => 'border-emerald-400/30 bg-emerald-500/10 text-emerald-200',
        'in-progress' => 'border-amber-400/30 bg-amber-500/10 text-amber-200',
        default => 'border-slate-400/30 bg-slate-600/20 text-slate-200',
    };
@endphp

<div class="relative pl-8 pb-10">
    <div class="absolute left-0 top-0 h-full w-px bg-white/10"></div>
    <span class="absolute left-0 top-0 flex h-3 w-3 -translate-x-[7px] rounded-full {{ $status === 'completed' ? 'bg-emerald-300' : ($status === 'in-progress' ? 'bg-amber-300' : 'bg-white/30') }}"></span>
    
    <article class="glass-card rounded-[24px] p-6">
        <span class="spotlight-ring"></span>
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm text-slate-300">{{ $description }}</p>
            </div>
            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] {{ $badgeClasses }}">
                {{ str($status)->replace('-', ' ')->title() }}
            </span>
        </div>
        <div class="mt-4 flex flex-wrap gap-4 text-xs text-slate-400">
            @if(isset($duration))
                <span class="rounded-full border border-white/10 bg-slate-900/60 px-3 py-1">{{ $duration }}</span>
            @endif
            @if(isset($lessons))
                <span class="rounded-full border border-white/10 bg-slate-900/60 px-3 py-1">{{ $lessons }} lessons</span>
            @endif
        </div>
        @if(isset($link) && $status !== 'completed')
            <div class="mt-6 flex justify-end">
                <x-public.button href="{{ $link }}" class="px-5 py-2 text-[0.75rem]">
                    {{ $status === 'in-progress' ? 'Continue' : 'Start' }}
                </x-public.button>
            </div>
        @endif
    </article>
</div>
