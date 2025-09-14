<!-- Bootcamps Section -->
<div id="bootcamps" class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Our Programs' }}"
            title="{{ $title ?? 'Available Bootcamps' }}"
            description="{{ $description ?? 'Choose from our carefully designed bootcamp programs.' }}"
        />
        
        <!-- Placeholder for bootcamp listings -->
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>