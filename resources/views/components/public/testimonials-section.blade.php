<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Testimonials"
            title="What Our Students Say"
            description="Hear from our graduates about their experience and how it transformed their careers."
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>