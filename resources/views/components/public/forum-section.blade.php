<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @php
            $ctaHref = $ctaLink ?? '#';
            $ctaLabel = $ctaText ?? 'New Post';
        @endphp

        <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <x-public.section-title 
                :subtitle="$subtitle ?? 'Community'"
                :title="$title ?? 'Discussion Forum'"
                :description="$description ?? 'Connect with fellow builders, share wins, and get feedback from mentors.'"
                align="left"
                maxWidth="max-w-2xl"
            />
            <x-public.button href="{{ $ctaHref }}" variant="secondary">
                {{ $ctaLabel }}
            </x-public.button>
        </div>
        
        <div class="mt-12 space-y-6">
            {{ $slot }}
        </div>
    </div>
</section>
