<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Roadmap'"
            :title="$title ?? 'Path to Mastery'"
            :description="$description ?? 'Follow milestone-by-milestone guidance to stay on track throughout the cohort.'"
        />
        
        <div class="mt-12 space-y-6">
            {{ $slot }}
        </div>
    </div>
</section>
