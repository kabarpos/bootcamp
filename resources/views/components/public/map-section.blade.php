<!-- Map Section -->
<div class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Our Location' }}"
            title="{{ $title ?? 'Visit Our Campus' }}"
            description="{{ $description ?? 'Come see our facilities and meet our team in person.' }}"
        />
        <div class="mt-10">
            <!-- Placeholder for map -->
            <div class="bg-card/80 backdrop-blur-sm border-2 border-dashed rounded-xl w-full h-96 flex items-center justify-center border-border shadow-lg">
                <span class="text-muted-foreground">{{ $placeholder ?? 'Map Placeholder' }}</span>
            </div>
        </div>
    </div>
</div>