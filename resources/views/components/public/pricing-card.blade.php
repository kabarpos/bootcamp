@php
    $isFeatured = isset($featured) && $featured;
@endphp

<article class="relative flex h-full flex-col overflow-hidden rounded-[30px] border border-white/12 bg-slate-900/65 p-8 shadow-[0_25px_50px_-30px_rgba(56,189,248,0.55)]">
    @if ($isFeatured)
        <div class="absolute inset-x-10 top-0 h-px bg-gradient-to-r from-sky-400 via-indigo-400 to-sky-400"></div>
        <span class="absolute right-8 top-8 inline-flex items-center gap-2 rounded-full border border-sky-400/40 bg-sky-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-sky-200">
            {{ $featuredText ?? 'Career accelerator' }}
        </span>
    @endif

    <div class="flex flex-1 flex-col gap-6">
        <div>
            <h3 class="text-2xl font-semibold text-white">{{ $title }}</h3>
            <div class="mt-4 flex items-baseline gap-2 text-white">
                <span class="text-4xl font-bold">{{ $price }}</span>
                @if (isset($frequency))
                    <span class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">
                        / {{ $frequency }}
                    </span>
                @endif
            </div>
            @if (isset($description))
                <p class="mt-4 text-sm text-slate-300">{{ $description }}</p>
            @endif
        </div>

        <ul class="space-y-4 text-sm text-slate-200">
            {{ $slot }}
        </ul>
    </div>

    <div class="mt-8 flex flex-col gap-3">
        <x-public.button
            href="{{ $buttonLink ?? '#' }}"
            :variant="$isFeatured ? 'primary' : 'secondary'"
            class="w-full justify-center"
            {{ $attributes }}
        >
            {{ $buttonText ?? 'Secure your seat' }}
        </x-public.button>
        <p class="text-xs text-slate-400">
            Flexible instalment plans and company invoicing available.
        </p>
    </div>
</article>
