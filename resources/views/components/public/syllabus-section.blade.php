<!-- Syllabus Section -->
<div class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Curriculum' }}"
            title="{{ $title ?? 'What You\'ll Learn' }}"
            description="{{ $description ?? 'Our comprehensive curriculum covers everything you need to know to succeed in your new career.' }}"
        />
        
        <div class="mt-10">
            <div class="space-y-10">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>