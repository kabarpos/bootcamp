<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_rgba(14,165,233,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle ?? 'Our Location'"
            :title="$title ?? 'Visit Our Campus'"
            :description="$description ?? 'Come see our facilities and meet our team in person.'"
        />
        <div class="mt-12">
            <div class="glass-panel flex h-96 w-full items-center justify-center rounded-[32px] border border-dashed border-white/15">
                <span class="text-sm uppercase tracking-[0.32em] text-slate-400">{{ $placeholder ?? 'Map Placeholder' }}</span>
            </div>
        </div>
    </div>
</section>
