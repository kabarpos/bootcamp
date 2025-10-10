<div {{ $attributes->merge(['class' => 'flex flex-col justify-between rounded-[32px] border border-white/10 bg-slate-950/70 p-6 shadow-[0_30px_90px_-45px_rgba(56,189,248,0.55)] backdrop-blur-2xl sm:p-8']) }}>
    <div class="space-y-3">
        <h3 class="text-xl font-semibold text-white">
            {{ $title }}
        </h3>

        <p class="text-sm leading-relaxed text-slate-300/85">
            {{ $description }}
        </p>
    </div>

    @isset($aside)
        <div class="mt-6 text-sm text-slate-300/80">
            {{ $aside }}
        </div>
    @endisset
</div>
