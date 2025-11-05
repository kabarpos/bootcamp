<section id="bootcamps" class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_rgba(56,189,248,0.18),_transparent_55%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle ?? 'Our programs'"
            :title="$title ?? 'Pick a learning path shaped by the industry'"
            :description="$description ?? 'Whether you are reskilling, upskilling, or launching your first role, our bootcamps combine live instruction, hands-on projects, and dedicated career support.'"
        />

        <div class="mt-12">
            <div class="glass-panel relative overflow-hidden rounded-[32px] p-6">
                <div class="absolute inset-0 opacity-40">
                    <div class="orbit-grid h-full w-full rounded-[32px] border border-white/5"></div>
                </div>
                <div class="relative flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-4">
                    <div class="text-sm font-medium text-slate-200">
                        <p>Filter by focus:</p>
                        <p class="text-xs text-slate-400">Web | Data &amp; AI | Product | DevOps</p>
                    </div>
                    <a href="{{ route('public.bootcamps') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-slate-900/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-300 transition hover:border-sky-400/40 hover:text-white cursor-pointer">
                        See all cohorts
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path d="M7 17L17 7M17 7H9M17 7v8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</section>
