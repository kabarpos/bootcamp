<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(14,165,233,0.12),_transparent_70%)]"></div>
    <div class="absolute inset-x-0 top-16 h-px bg-gradient-to-r from-transparent via-white/12 to-transparent"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle ?? 'Investment options'"
            :title="$title ?? 'Choose the path that fits your goals'"
            :description="$description ?? 'All plans include access to live instruction, mentor pods, interview labs, and lifetime access to our alumni guild.'"
        />

        <div class="mt-14 grid grid-cols-1 gap-8 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
