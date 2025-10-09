<article class="glass-card group relative flex h-full flex-col overflow-hidden rounded-[28px]">
    <span class="spotlight-ring"></span>

    <figure class="relative h-40 w-full overflow-hidden">
        <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $image }}" alt="{{ $alt }}">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent"></div>
        <div class="absolute inset-x-6 bottom-4 flex items-center justify-between text-xs font-semibold uppercase tracking-[0.22em] text-slate-200">
            <span class="rounded-full border border-white/20 bg-slate-900/60 px-3 py-1 text-[0.7rem]">{{ $category }}</span>
            @if (isset($level))
                <span class="rounded-full border border-sky-400/40 bg-sky-500/10 px-3 py-1 text-[0.7rem] text-sky-200">{{ $level }}</span>
            @endif
        </div>
    </figure>

    <div class="flex flex-1 flex-col gap-6 p-6">
        <a href="{{ $titleLink }}" class="space-y-3">
            <h3 class="text-xl font-semibold text-white transition group-hover:text-sky-200">{{ $title }}</h3>
            <p class="text-sm text-slate-300">
                {{ $description }}
            </p>
        </a>

        <div class="grid grid-cols-2 gap-3 rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-xs">
            <div class="flex flex-col gap-1 text-slate-300">
                <span class="text-[0.65rem] uppercase tracking-[0.32em] text-slate-500">Duration</span>
                <span class="text-sm font-semibold text-slate-100">{{ $duration }}</span>
            </div>
            <div class="flex flex-col gap-1 text-slate-300">
                <span class="text-[0.65rem] uppercase tracking-[0.32em] text-slate-500">Investment</span>
                <span class="text-sm font-semibold text-slate-100">{{ $price }}</span>
            </div>
        </div>

        <div class="mt-auto flex items-center justify-between">
            <div class="flex items-center gap-2 text-[0.75rem] font-semibold uppercase tracking-[0.24em] text-slate-500">
                Cohort seats
                <span class="inline-flex items-center rounded-full border border-emerald-400/30 bg-emerald-500/10 px-2.5 py-1 text-[0.65rem] text-emerald-200">
                    Limited
                </span>
            </div>
            <x-public.button href="{{ $titleLink }}" class="px-5 py-2 text-[0.75rem]">
                Program details
            </x-public.button>
        </div>
    </div>
</article>
