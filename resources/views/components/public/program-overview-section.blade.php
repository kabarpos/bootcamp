@php
    $subtitle = $subtitle ?? 'Program Overview';
    $title = $title ?? "What You'll Learn";
    $description = $description ?? 'A curriculum crafted with industry partners to help you ship real products.';
@endphp

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(99,102,241,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle"
            :title="$title"
            :description="$description"
            align="left"
            maxWidth="max-w-3xl"
        />

        <div class="mt-12 grid grid-cols-1 gap-8 lg:grid-cols-2">
            {{ $slot }}
        </div>
    </div>
</section>
