@php
    $embedUrl = $mapEmbedUrl ?? null;
@endphp

<section class="relative">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_rgba(14,165,233,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl ">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Our Location'"
            :title="$title ?? 'Visit Our Campus'"
            :description="$description ?? 'Come see our facilities and meet our team in person.'"
        />
        <div class="mt-12">
            @if($embedUrl)
                <div class="glass-card relative overflow-hidden rounded-[32px] border border-white/10">
                    <span class="spotlight-ring"></span>
                    <iframe
                        src="{{ $embedUrl }}"
                        width="100%"
                        height="420"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="block w-full rounded-[32px] cursor-pointer"
                    ></iframe>
                </div>
            @else
                <div class="glass-panel flex h-96 w-full items-center justify-center rounded-[32px] border border-dashed border-white/15">
                    <span class="text-sm uppercase tracking-[0.32em] text-slate-400">{{ $placeholder ?? 'Map Placeholder' }}</span>
                </div>
            @endif
        </div>
    </div>
</section>
