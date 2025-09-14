<!-- Features Section -->
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Why Choose Us' }}"
            title="{{ $title ?? 'The Best Learning Experience' }}"
            description="{{ $description ?? 'We provide everything you need to succeed in your tech career.' }}"
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>