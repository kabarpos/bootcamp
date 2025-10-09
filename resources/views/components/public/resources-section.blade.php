<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(99,102,241,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Resources'"
            :title="$title ?? 'Learning Library'"
            :description="$description ?? 'Curated guides, templates, and recordings to support your momentum between sessions.'"
        />
        
        <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
