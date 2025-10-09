<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(14,165,233,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Assessments'"
            :title="$title ?? 'Quizzes & Tests'"
            :description="$description ?? 'Measure your mastery and track progress across each sprint of the cohort.'"
        />
        
        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
