<!-- Instructor Section -->
<div class="py-12 bg-card/80 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Meet Your Instructor' }}"
            title="{{ $title ?? 'Industry Expert' }}"
            description="{{ $description ?? 'Learn from someone who has been in the industry for over a decade.' }}"
        />
        
        <div class="mt-10">
            <div class="flex flex-col md:flex-row items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                <div class="md:w-1/3 flex justify-center">
                    <img class="w-64 h-64 rounded-full object-cover" src="{{ $image }}" alt="{{ $name }}">
                </div>
                <div class="mt-8 md:mt-0 md:w-2/3 md:pl-12">
                    <h3 class="text-2xl font-bold text-foreground">{{ $name }}</h3>
                    <p class="mt-2 text-primary">{{ $position }}</p>
                    <p class="mt-4 text-muted-foreground">
                        {{ $bio1 }}
                    </p>
                    <p class="mt-4 text-muted-foreground">
                        {{ $bio2 }}
                    </p>
                    <div class="mt-6">
                        <div class="flex items-center">
                            {{ $rating }}
                            <span class="ml-2 text-sm text-muted-foreground">{{ $reviews }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>