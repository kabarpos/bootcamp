<article class="group glass-card relative h-full overflow-hidden rounded-[26px] p-8">
    <span class="spotlight-ring"></span>
    <div class="relative flex h-full flex-col gap-6">
        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-slate-900/70 text-sky-300 transition group-hover:border-sky-500/30 group-hover:text-sky-200">
            {{ $icon }}
        </div>

        <div class="space-y-3">
            <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
            <p class="text-sm text-slate-300">
                {{ $description }}
            </p>
        </div>

        <div class="mt-auto flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.28em] text-slate-500 transition group-hover:text-slate-300">
            Proven outcomes
            <span class="h-[2px] w-8 rounded-full bg-gradient-to-r from-sky-400/80 to-indigo-400/80"></span>
        </div>
    </div>
</article>
