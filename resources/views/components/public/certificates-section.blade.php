<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Certificates'"
            :title="$title ?? 'Your Achievements'"
            :description="$description ?? 'Track your progress and download certificates as you complete milestones.'"
        />
        
        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
