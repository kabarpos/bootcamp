<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary/10 text-primary">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
            <p class="mt-1 text-sm text-muted-foreground">{{ $postedAt }}</p>
            <p class="mt-2 text-muted-foreground">
                {{ $content }}
            </p>
            @if(isset($link))
            <div class="mt-4">
                <a href="{{ $link }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                    {{ $linkText ?? 'Learn more' }}
                    <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>