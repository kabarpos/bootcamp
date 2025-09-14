<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-foreground">{{ $title }}</h3>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                @if($status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                @elseif($status === 'in-progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                @else bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                @endif">
                {{ ucfirst(str_replace('-', ' ', $status)) }}
            </span>
        </div>
        <p class="mt-2 text-muted-foreground">
            {{ $description }}
        </p>
        <div class="mt-4">
            @if($status === 'completed')
            <x-public.progress-bar :percentage="100" :label="'Completed on ' . $completedDate" />
            @else
            <x-public.progress-bar :percentage="$progress ?? 0" :label="$progressLabel ?? 'In Progress'" />
            @endif
        </div>
    </div>
    <div class="px-6 py-4 bg-card/50 border-t border-border">
        <div class="flex justify-between items-center">
            <span class="text-sm text-muted-foreground">{{ $duration }}</span>
            @if($status === 'completed')
            <a href="{{ $downloadLink ?? '#' }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                Download Certificate
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            @else
            <a href="{{ $continueLink ?? '#' }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                {{ $actionText ?? 'Continue' }}
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            @endif
        </div>
    </div>
</div>