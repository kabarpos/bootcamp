<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <div class="flex items-center justify-center h-12 w-12 rounded-md 
                @if($status === 'completed') bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-300
                @elseif($status === 'in-progress') bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-300
                @else bg-border text-muted-foreground
                @endif">
                @if($status === 'completed')
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                @elseif($status === 'in-progress')
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                @else
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                </svg>
                @endif
            </div>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
            <p class="mt-1 text-sm text-muted-foreground">{{ $description }}</p>
        </div>
    </div>
    <div class="mt-4">
        <div class="flex justify-between text-sm text-muted-foreground">
            <span>{{ $date }}</span>
            @if($status === 'completed')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                Completed
            </span>
            @elseif($status === 'in-progress')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                In Progress
            </span>
            @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-border text-muted-foreground">
                Pending
            </span>
            @endif
        </div>
    </div>
</div>