<section class="relative border-y border-white/5 bg-slate-950/60 backdrop-blur-xl">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(56,189,248,0.12),_transparent_70%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="glass-panel flex flex-col gap-6 rounded-[32px] border border-white/10 px-6 py-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-white">{{ $title ?? 'All Bootcamps' }}</h2>
                <p class="mt-2 text-sm text-slate-300">{{ $description ?? 'Filter cohorts by focus area, difficulty, and schedule to match your goals.' }}</p>
            </div>
            <div class="flex flex-wrap gap-3 sm:justify-end">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
