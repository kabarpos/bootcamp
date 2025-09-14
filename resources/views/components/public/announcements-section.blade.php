<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Announcements"
            title="Latest Updates"
            description="Stay informed with the latest news and updates."
        />
        
        <div class="mt-10">
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>