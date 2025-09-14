<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Leaderboard"
            title="Top Performers"
            description="See how you rank among your peers in the program."
        />
        
        <div class="mt-10">
            <div class="space-y-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>