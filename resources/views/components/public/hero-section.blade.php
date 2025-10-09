@php
    $titleLine1 = $titleLine1 ?? 'Build your next chapter with';
    $titleLine2 = $titleLine2 ?? 'industry-backed bootcamps';
    $description = $description ?? 'Learn the skills top tech teams hire for. Guided by senior engineers, powered by projects that mirror real product challenges.';
    $exploreLink = $exploreLink ?? '#bootcamps';
    $exploreText = $exploreText ?? 'Browse programs';
    $contactLink = $contactLink ?? '#contact';
    $contactText = $contactText ?? 'Talk to an advisor';
    $stats = $stats ?? [
        ['label' => 'Hiring partners', 'value' => '70+'],
        ['label' => 'Graduate salary uplift', 'value' => '82%'],
        ['label' => 'Projects shipped', 'value' => '140'],
    ];
    $brands = $brands ?? ['Google', 'Tokopedia', 'Gojek', 'Shopee'];
@endphp

<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.25),_transparent_55%),radial-gradient(circle_at_bottom_left,_rgba(99,102,241,0.25),_transparent_50%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 pb-16 pt-24 sm:px-6 lg:flex lg:items-center lg:px-8 lg:pt-28">
        <div class="grid w-full gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div class="space-y-8 text-slate-200">
                <span class="inline-flex items-center gap-2 rounded-full border border-sky-400/30 bg-sky-400/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/90">
                    Next cohort opens 11 November
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                </span>

                <div class="space-y-4">
                    <h1 class="text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                        <span class="block">{{ $titleLine1 }}</span>
                        <span class="block bg-gradient-to-br from-sky-300 via-blue-400 to-indigo-400 bg-clip-text text-transparent">
                            {{ $titleLine2 }}
                        </span>
                    </h1>
                    <p class="max-w-2xl text-lg text-slate-300 sm:text-xl">
                        {{ $description }}
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                    <x-public.button href="{{ $exploreLink }}" data-umami-event="hero-explore-programs">
                        {{ $exploreText }}
                    </x-public.button>
                    <div class="flex items-center gap-3">
                        <x-public.button href="{{ $contactLink }}" variant="secondary">
                            {{ $contactText }}
                        </x-public.button>
                        <span class="text-sm font-medium text-slate-300">
                            or call us at
                            <a href="tel:+62811888000" class="text-sky-300 hover:text-sky-200">+62 811-888-000</a>
                        </span>
                    </div>
                </div>

                <dl class="grid gap-6 sm:grid-cols-3">
                    @foreach ($stats as $stat)
                        <div class="rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-5 backdrop-blur-xl">
                            <dt class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">{{ $stat['label'] }}</dt>
                            <dd class="mt-3 text-3xl font-semibold text-white">{{ $stat['value'] }}</dd>
                        </div>
                    @endforeach
                </dl>

                {{-- <div class="mt-4 flex flex-wrap items-center gap-6 text-xs uppercase tracking-[0.4em] text-slate-500">
                    <span class="text-slate-400/80">Trusted by alumni working at</span>
                    @foreach ($brands as $brand)
                        <span class="rounded-full border border-white/10 bg-slate-900/50 px-4 py-2 text-[0.75rem] text-slate-300">{{ $brand }}</span>
                    @endforeach
                </div> --}}
            </div>

            <div class="relative h-full">
                <div class="glass-card group relative mx-auto max-w-[420px] rounded-[32px] p-6">
                    <span class="spotlight-ring"></span>
                    <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900/90 via-slate-900/70 to-slate-900/40 p-6">
                        <div class="absolute inset-0 opacity-60">
                            <div class="orbit-grid h-full w-full rounded-3xl border border-white/5"></div>
                        </div>

                        <div class="relative space-y-6">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.28em] text-sky-300/80">Flagship program</p>
                                    <p class="mt-2 text-2xl font-semibold text-white">Full-stack Catalyst</p>
                                </div>
                                <span class="inline-flex items-center rounded-full border border-sky-400/40 bg-sky-400/10 px-3 py-1 text-[0.75rem] font-semibold uppercase tracking-wide text-sky-200">
                                    12 weeks
                                </span>
                            </div>

                            <div class="space-y-4 text-sm text-slate-300">
                                <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-500/15 text-sky-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-white">Weekly sprints</p>
                                        <p class="text-xs text-slate-400">Live build sessions with senior mentors</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/15 text-indigo-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 3v18M5 12h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-white">Career fast-track</p>
                                        <p class="text-xs text-slate-400">1:1 interview labs & hiring partner demo day</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-white">Outcomes guaranteed</p>
                                        <p class="text-xs text-slate-400">Placement support until you land your role</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-white/10 bg-black/30 p-4 text-xs text-slate-400">
                                “I shipped two production-ready projects in 10 weeks and doubled my salary as a junior engineer.”
                                <div class="mt-4 flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?auto=format&fit=facearea&w=96&h=96&q=80" alt="Graduate photo" class="h-10 w-10 rounded-full object-cover">
                                    <div class="text-sm text-slate-300">
                                        <p class="font-semibold text-white">Alya Hartono</p>
                                        <p class="text-xs text-slate-400">Backend Engineer @ Tokopedia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
