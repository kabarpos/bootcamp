@php
    $subtitle = $subtitle ?? 'Curriculum';
    $title = $title ?? "What You'll Learn";
    $description = $description ?? 'Our curriculum blends fundamentals, advanced tooling, and product context so you can build with confidence.';
@endphp

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle"
            :title="$title"
            :description="$description"
            align="left"
            maxWidth="max-w-3xl"
        />
        
        <div class="mt-12 space-y-10">
            {{ $slot }}
        </div>
    </div>
</section>
