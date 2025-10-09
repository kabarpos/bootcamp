<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Upcoming'"
            :title="$title ?? 'Events & Deadlines'"
            :description="$description ?? 'Stay ahead of key milestones, mentor sessions, and submission deadlines.'"
        />
        
        <div class="mt-12 space-y-4">
            {{ $slot }}
        </div>
    </div>
</section>
