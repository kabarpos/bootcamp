<div class="flex items-start p-4 bg-card/80 backdrop-blur-sm border border-border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex-shrink-0">
        <div class="flex flex-col items-center justify-center h-12 w-12 rounded-md bg-primary/10 text-primary">
            <span class="text-sm font-bold">{{ $day }}</span>
            <span class="text-xs">{{ $month }}</span>
        </div>
    </div>
    <div class="ml-4">
        <h4 class="text-lg font-medium text-foreground">{{ $title }}</h4>
        <p class="mt-1 text-sm text-muted-foreground">{{ $description }}</p>
        <div class="mt-2 flex items-center text-sm text-muted-foreground">
            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
            </svg>
            {{ $time }}
        </div>
    </div>
</div>