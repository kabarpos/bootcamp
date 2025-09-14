<!-- Team Section -->
<div class="py-12 bg-card/80 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Our Team' }}"
            title="{{ $title ?? 'Meet Our Leadership' }}"
            description="{{ $description ?? 'Passionate educators and industry experts driving our mission forward.' }}"
        />
        
        <div class="mt-12">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>