<section id="bootcamps" class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_rgba(56,189,248,0.18),_transparent_55%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.55fr_1fr] lg:items-center">
            <div class="space-y-8">
                <x-public.section-title
                    :subtitle="$subtitle ?? 'Our programs'"
                    :title="$title ?? 'Pick a learning path shaped by the industry'"
                    :description="$description ?? 'Whether you are reskilling, upskilling, or launching your first role, our bootcamps combine live instruction, hands-on projects, and dedicated career support.'"
                    align="left"
                    maxWidth="max-w-xl"
                />

                <div class="grid gap-4">
                    <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-slate-900/60 px-5 py-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-500/10 text-sky-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-white">Live & async blend</p>
                            <p class="text-xs text-slate-300">8–16 week cohorts with dedicated mentor pods and Slack office hours.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-slate-900/60 px-5 py-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-white">Career support that sticks</p>
                            <p class="text-xs text-slate-300">Personalized job map, interview labs, and hiring partner demo day access.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-panel relative overflow-hidden rounded-[32px] p-6">
                <div class="absolute inset-0 opacity-40">
                    <div class="orbit-grid h-full w-full rounded-[32px] border border-white/5"></div>
                </div>
                <div class="relative flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-4">
                    <div class="text-sm font-medium text-slate-200">
                        <p>Filter by focus:</p>
                        <p class="text-xs text-slate-400">Web · Data & AI · Product · DevOps</p>
                    </div>
                    <a href="{{ route('public.bootcamps') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-slate-900/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-300 transition hover:border-sky-400/40 hover:text-white">
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
