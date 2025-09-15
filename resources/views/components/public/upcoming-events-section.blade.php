<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Upcoming"
            title="Events & Deadlines"
            description="Stay on track with important dates and events."
        />
        
        <div class="mt-10">
            <div class="space-y-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>