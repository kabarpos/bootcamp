@php
    $status = $status ?? 'in-progress';
    $statusStyles = match($status) {
        'completed' => 'border-emerald-400/30 bg-emerald-500/10 text-emerald-200',
        'in-progress' => 'border-amber-400/30 bg-amber-500/10 text-amber-200',
        default => 'border-sky-400/30 bg-sky-500/10 text-sky-200',
    };
    $ctaHref = $status === 'completed' ? ($downloadLink ?? '#') : ($continueLink ?? '#');
    $ctaLabel = $status === 'completed'
        ? ($downloadLabel ?? 'Download Certificate')
        : ($actionText ?? 'Continue');
@endphp

<article class="glass-card group flex h-full flex-col justify-between rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="space-y-5">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
                @if(isset($description))
                    <p class="mt-2 text-sm text-slate-300">{{ $description }}</p>
                @endif
            </div>
            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] {{ $statusStyles }}">
                {{ str($status)->replace('-', ' ')->title() }}
            </span>
        </div>

        @if($status === 'completed' && isset($completedDate))
            <x-public.progress-bar :percentage="100" :label="'Completed on ' . $completedDate" />
        @elseif(isset($progress))
            <x-public.progress-bar :percentage="$progress" :label="$progressLabel ?? 'In Progress'" />
        @endif

        @if(isset($duration))
            <p class="text-xs text-slate-400">Estimated effort: {{ $duration }}</p>
        @endif
    </div>

    <div class="mt-6 flex items-center justify-between border-t border-white/5 pt-4 text-xs text-slate-400">
        <span>{{ $status === 'completed' ? 'Certified' : 'Keep going' }}</span>
        <x-public.button href="{{ $ctaHref }}" class="px-5 py-2 text-[0.75rem]">
            {{ $ctaLabel }}
        </x-public.button>
    </div>
</article>
