<section class="relative py-20">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="absolute inset-x-0 top-12 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.55fr_1fr] lg:items-center">
            <div>
                <x-public.section-title
                    :subtitle="$subtitle ?? 'Why join NovaTech'"
                    :title="$title ?? 'Designed for builders, crafted with industry'"
                    :description="$description ?? 'Every cohort pairs pragmatic curriculum with deep mentorship, accelerating you from fundamentals to production-ready skills.'"
                    align="left"
                    maxWidth="max-w-xl"
                />

                <div class="mt-12 grid gap-6 rounded-3xl border border-white/10 bg-slate-900/60 p-6 shadow-[0_22px_40px_-30px_rgba(56,189,248,0.55)] lg:pr-10">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-500/10 text-sky-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12l4 3 9-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-base font-semibold text-white">Curriculum iterated with partner teams</p>
                            <p class="mt-2 text-sm text-slate-300">Endorsed by tech leaders building at Gojek, Xendit, and Tokopedia to ensure every sprint mirrors workplace challenges.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-300">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-base font-semibold text-white">Projects with real product constraints</p>
                            <p class="mt-2 text-sm text-slate-300">Ship capstone work sourced from startups who review your pull requests, ensuring your portfolio tells real product stories.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
