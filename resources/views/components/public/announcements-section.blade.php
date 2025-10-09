<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(56,189,248,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Announcements'"
            :title="$title ?? 'Latest Updates'"
            :description="$description ?? 'Stay informed with the latest news, resources, and cohort updates.'"
        />
        
        <div class="mt-12 space-y-6">
            {{ $slot }}
        </div>
    </div>
</section>
