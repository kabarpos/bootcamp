<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,0.12),_transparent_60%)]"></div>
    <div class="absolute inset-x-0 top-10 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle ?? 'Graduate stories'"
            :title="$title ?? 'Fueling career jumps across Southeast Asia'"
            :description="$description ?? 'Our alumni have launched new careers, shipped products, and joined leading engineering teams. Hear how the experience reshaped their trajectory.'"
        />

        <div class="mt-12">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
