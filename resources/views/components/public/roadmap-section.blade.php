<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Learning Path"
            title="Your Roadmap to Success"
            description="Follow this structured path to become a professional developer."
        />
        
        <div class="mt-10">
            <div class="space-y-0">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>