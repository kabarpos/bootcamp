<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(99,102,241,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Milestones'"
            :title="$title ?? 'Your Learning Journey'"
            :description="$description ?? 'Track progress across the key checkpoints in your cohort experience.'"
        />
        
        <div class="mt-12 space-y-6">
            {{ $slot }}
        </div>
    </div>
</section>
