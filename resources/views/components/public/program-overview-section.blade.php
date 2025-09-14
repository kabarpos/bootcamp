<!-- Program Overview -->
<div class="py-12 bg-card/80 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Program Overview' }}"
            title="{{ $title ?? 'What You\'ll Learn' }}"
            description="{{ $description ?? 'A comprehensive curriculum designed by industry experts to give you the skills employers want.' }}"
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>