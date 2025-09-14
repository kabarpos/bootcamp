<div class="relative pl-8 pb-8 group">
    <!-- Vertical line -->
    <div class="absolute left-0 top-0 h-full w-0.5 bg-border"></div>
    
    <!-- Circle marker -->
    <div class="absolute left-0 top-0 h-4 w-4 rounded-full bg-primary -translate-x-1/2 translate-y-1
        @if($status === 'completed') bg-primary
        @elseif($status === 'in-progress') bg-yellow-500
        @else bg-border
        @endif">
    </div>
    
    <div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
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
            <div class="flex justify-between text-sm text-muted-foreground">
                <span>{{ $duration }}</span>
                <span>{{ $lessons }} lessons</span>
            </div>
        </div>
        @if($status !== 'completed')
        <div class="mt-4">
            <a href="{{ $link ?? '#' }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                {{ $status === 'in-progress' ? 'Continue' : 'Start' }}
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        @endif
    </div>
</div>