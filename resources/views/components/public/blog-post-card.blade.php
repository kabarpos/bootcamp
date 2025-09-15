<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
    <div class="aspect-w-16 aspect-h-9">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    </div>
    <div class="p-6">
        <h3 class="text-xl font-semibold text-foreground">{{ $title }}</h3>
        <p class="mt-2 text-muted-foreground">
            {{ $excerpt }}
        </p>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="text-sm">
                    <p class="text-foreground font-medium">{{ $author }}</p>
                    <p class="text-muted-foreground">{{ $date }}</p>
                </div>
            </div>
            <a href="{{ $link }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                Read more
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>