<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ $status }}</p>
        </div>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
            {{ $progress }}%
        </span>
    </div>
    
    <div class="mt-4">
        <x-public.progress-bar :percentage="$progress" />
    </div>
    
    <div class="mt-4">
        <a href="#" class="text-sm font-medium text-primary hover:text-primary/80 cursor-pointer">
            Continue Learning
            <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>