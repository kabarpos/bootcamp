<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-foreground">{{ $title }}</h3>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary">
                {{ $duration }}
            </span>
        </div>
        <p class="mt-2 text-muted-foreground">
            {{ $description }}
        </p>
        <div class="mt-4">
            <x-public.progress-bar :percentage="$progress ?? 0" :label="$progressLabel ?? 'Completion'" />
        </div>
    </div>
    <div class="px-6 py-4 bg-card/50 border-t border-border">
        <div class="flex justify-between items-center">
            <span class="text-sm text-muted-foreground">{{ $lessons }} lessons</span>
            <a href="{{ $link ?? '#' }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                {{ $actionText ?? 'Continue' }}
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>