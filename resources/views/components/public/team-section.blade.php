<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(99,102,241,0.16),_transparent_60%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle ?? 'Meet the mentors'"
            :title="$title ?? 'Educators who build products, not just slides'"
            :description="$description ?? 'Our mentors blend experience from unicorn startups, global tech giants, and fast-growing scale-ups across Southeast Asia.'"
        />

        <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
