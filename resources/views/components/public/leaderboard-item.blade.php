<div class="flex items-center p-4 bg-card/80 backdrop-blur-sm border border-border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex-shrink-0 w-8 text-center">
        @if($position == 1)
        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
            {{ $position }}
        </span>
        @elseif($position == 2)
        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700/30 dark:text-gray-300">
            {{ $position }}
        </span>
        @elseif($position == 3)
        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
            {{ $position }}
        </span>
        @else
        <span class="text-muted-foreground">
            {{ $position }}
        </span>
        @endif
    </div>
    <div class="ml-4 flex-shrink-0">
        <img class="h-10 w-10 rounded-full" src="{{ $avatar }}" alt="{{ $name }}">
    </div>
    <div class="ml-4 flex-1 min-w-0">
        <h4 class="text-lg font-medium text-foreground truncate">{{ $name }}</h4>
        <p class="text-sm text-muted-foreground truncate">{{ $bootcamp }}</p>
    </div>
    <div class="ml-4 flex-shrink-0">
        <div class="text-right">
            <p class="text-lg font-semibold text-foreground">{{ $points }}</p>
            <p class="text-sm text-muted-foreground">points</p>
        </div>
    </div>
</div>