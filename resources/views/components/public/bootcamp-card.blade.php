<div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card transition-all duration-300 hover:shadow-xl">
    <div class="flex-shrink-0">
        <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $alt }}">
    </div>
    <div class="flex-1 p-6 flex flex-col justify-between">
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                    {{ $category }}
                </span>
                @if(isset($level))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    @if($level === 'Beginner') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                    @elseif($level === 'Intermediate') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                    @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                    @endif backdrop-blur-sm">
                    {{ $level }}
                </span>
                @endif
            </div>
            <a href="{{ $titleLink }}" class="block mt-4">
                <p class="text-xl font-semibold text-foreground hover:text-primary transition-colors duration-300">{{ $title }}</p>
                <p class="mt-3 text-base text-muted-foreground">
                    {{ $description }}
                </p>
            </a>
        </div>
        <div class="mt-6 flex items-center">
            <div class="flex-shrink-0">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                    {{ $duration }}
                </span>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-foreground">
                    {{ $price }}
                </p>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ $titleLink }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm transition-colors duration-300">
                View Details
            </a>
        </div>
    </div>
</div>