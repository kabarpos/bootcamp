<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Pricing' }}"
            title="{{ $title ?? 'Simple, Transparent Pricing' }}"
            description="{{ $description ?? 'Choose the plan that works best for you. All plans include our core features.' }}"
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>