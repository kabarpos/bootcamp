<article class="glass-card relative h-full overflow-hidden rounded-[28px] p-8">
    <span class="spotlight-ring"></span>
    <div class="relative flex h-full flex-col gap-5">
        <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
        <div class="space-y-4 text-sm text-slate-300">
            {{ $slot }}
        </div>
        <span class="mt-auto inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.28em] text-slate-500">
            <span class="h-[2px] w-6 rounded-full bg-gradient-to-r from-sky-300 to-indigo-400"></span>
            NovaTech advantage
        </span>
    </div>
</article>
