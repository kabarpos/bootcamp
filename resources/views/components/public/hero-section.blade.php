@php
    $titleLine1 = $titleLine1 ?? 'Bangun karir mulai dari';
    $titleLine2 = $titleLine2 ?? 'Sekarang Juga..!';
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
    $heroImage = $heroImage ?? asset('assets/images/hero/image-hero.webp');
    $heroImageAlt = $heroImageAlt ?? 'Bootcamp cohort collaborating in workspace';
@endphp

<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.25),_transparent_55%),radial-gradient(circle_at_bottom_left,_rgba(99,102,241,0.25),_transparent_50%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 pb-16 pt-24 sm:px-6 lg:flex lg:items-center lg:px-8 lg:pt-28">
        <div class="grid w-full gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div class="space-y-8 text-slate-200">
                <span class="inline-flex items-center gap-2 rounded-full border border-sky-400/30 bg-sky-400/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/90">
                    Waktu Terbaik Untuk Memulai
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                </span>

                <div class="space-y-4">
                    <h1 class="text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                        <span class="inline">{{ $titleLine1 }}</span>
                        <span class="inline bg-gradient-to-br from-sky-300 via-blue-400 to-indigo-400 bg-clip-text text-transparent">
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

                    </div>
                </div>
{{--
                <dl class="grid gap-6 sm:grid-cols-3">
                    @foreach ($stats as $stat)
                        <div class="rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-5 backdrop-blur-xl">
                            <dt class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">{{ $stat['label'] }}</dt>
                            <dd class="mt-3 text-3xl font-semibold text-white">{{ $stat['value'] }}</dd>
                        </div>
                    @endforeach
                </dl> --}}

                {{-- <div class="mt-4 flex flex-wrap items-center gap-6 text-xs uppercase tracking-[0.4em] text-slate-500">
                    <span class="text-slate-400/80">Trusted by alumni working at</span>
                    @foreach ($brands as $brand)
                        <span class="rounded-full border border-white/10 bg-slate-900/50 px-4 py-2 text-[0.75rem] text-slate-300">{{ $brand }}</span>
                    @endforeach
                </div> --}}
            </div>

            <div class="relative h-full">
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                    <div class="relative overflow-hidden ">
                        <img src="{{ $heroImage }}" alt="{{ $heroImageAlt }}" class="w-full object-cover">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
