<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Leaderboard'"
            :title="$title ?? 'Top Performers'"
            :description="$description ?? 'See how you rank among peers across sprints and mastery checkpoints.'"
        />
        
        <div class="mt-12 space-y-4">
            {{ $slot }}
        </div>
    </div>
</section>
