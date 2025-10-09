@php
    $status = $status ?? 'not-started';
    $statusStyles = match($status) {
        'completed' => 'border-emerald-400/30 bg-emerald-500/10 text-emerald-200',
        'in-progress' => 'border-amber-400/30 bg-amber-500/10 text-amber-200',
        default => 'border-sky-400/30 bg-sky-500/10 text-sky-200',
    };
    $ctaHref = $status === 'completed' ? ($viewLink ?? '#') : ($startLink ?? '#');
    $ctaLabel = $status === 'completed'
        ? ($viewLabel ?? 'View Project')
        : ($status === 'in-progress' ? ($continueLabel ?? 'Continue') : ($startLabel ?? 'Start Project'));
@endphp

<article class="glass-card group flex h-full flex-col justify-between rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="space-y-5">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm text-slate-300">{{ $description }}</p>
            </div>
            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] {{ $statusStyles }}">
                {{ str($status)->replace('-', ' ')->title() }}
            </span>
        </div>
        <dl class="grid grid-cols-2 gap-3 text-xs text-slate-400">
            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-3 py-2">
                <dt class="uppercase tracking-[0.26em]">Technologies</dt>
                <dd class="mt-1 text-sm text-slate-200">{{ $technologies }}</dd>
            </div>
            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-3 py-2">
                <dt class="uppercase tracking-[0.26em]">Duration</dt>
                <dd class="mt-1 text-sm text-slate-200">{{ $duration }}</dd>
            </div>
        </dl>
        @if($status === 'completed' && isset($completedDate))
            <p class="text-xs text-emerald-200/80">Submitted on {{ $completedDate }}</p>
        @elseif(isset($difficulty))
            <p class="text-xs text-slate-400">Difficulty: {{ $difficulty }}</p>
        @endif
    </div>

    <div class="mt-6 flex items-center justify-between border-t border-white/5 pt-4">
        <span class="text-xs uppercase tracking-[0.3em] text-slate-500">
            {{ $status === 'completed' ? 'Ready for review' : 'Sprint checkpoint' }}
        </span>
        <x-public.button href="{{ $ctaHref }}" class="px-5 py-2 text-[0.75rem]">
            {{ $ctaLabel }}
        </x-public.button>
    </div>
</article>
