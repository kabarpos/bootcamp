<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Projects'"
            :title="$title ?? 'Hands-on Projects'"
            :description="$description ?? 'Ship real-world applications that demonstrate your technical depth and product thinking.'"
        />
        
        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            {{ $slot }}
        </div>
    </div>
</section>
