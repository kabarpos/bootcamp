<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm">
    <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
    <div class="mt-4">
        <x-public.progress-bar :percentage="$percentage" :label="$label" />
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-foreground">{{ $completed }}</p>
            <p class="text-sm text-muted-foreground">Completed</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-foreground">{{ $remaining }}</p>
            <p class="text-sm text-muted-foreground">Remaining</p>
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ $link ?? '#' }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm transition-colors duration-300">
            {{ $buttonText ?? 'Continue Learning' }}
        </a>
    </div>
</div>