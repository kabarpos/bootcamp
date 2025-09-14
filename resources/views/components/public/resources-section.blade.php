<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Resources"
            title="Learning Materials"
            description="Access additional resources to support your learning journey."
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>