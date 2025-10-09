<article class="glass-card group flex h-full flex-col justify-between rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="space-y-4">
        <div class="flex items-start justify-between gap-3">
            <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
            @if(isset($duration))
                <span class="inline-flex items-center rounded-full border border-sky-400/40 bg-sky-500/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.28em] text-sky-200">
                    {{ $duration }}
                </span>
            @endif
        </div>
        @if(isset($description))
            <p class="text-sm text-slate-300">{{ $description }}</p>
        @endif
        @if(isset($progress))
            <x-public.progress-bar :percentage="$progress" :label="$progressLabel ?? 'Completion'" />
        @endif
    </div>

    <div class="mt-6 flex items-center justify-between border-t border-white/5 pt-4 text-xs text-slate-400">
        <span>{{ $lessons ?? 'Module' }} lessons</span>
        <x-public.button href="{{ $link ?? '#' }}" class="px-5 py-2 text-[0.75rem]">
            {{ $actionText ?? 'Continue' }}
        </x-public.button>
    </div>
</article>
