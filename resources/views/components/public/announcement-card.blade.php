<article class="glass-card relative flex h-full gap-4 overflow-hidden rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-sky-500/10 text-sky-300">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="space-y-3">
        <div class="space-y-1">
            <h3 class="text-base font-semibold text-white">{{ $title }}</h3>
            @if(isset($postedAt))
                <p class="text-xs uppercase tracking-[0.26em] text-slate-500">{{ $postedAt }}</p>
            @endif
        </div>
        <p class="text-sm text-slate-300">
            {{ $content }}
        </p>
        @if(isset($link))
            <a href="{{ $link }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200 transition hover:text-sky-100">
                {{ $linkText ?? 'Learn more' }}
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 6h10m0 0v10m0-10L5 20" />
                </svg>
            </a>
        @endif
    </div>
</article>
