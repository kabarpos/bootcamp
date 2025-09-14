<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-center">
        <img class="h-12 w-12 rounded-full" src="{{ $image }}" alt="{{ $name }}">
        <div class="ml-4">
            <h4 class="text-lg font-semibold text-foreground">{{ $name }}</h4>
            <p class="text-sm text-muted-foreground">{{ $position }}</p>
        </div>
    </div>
    <div class="mt-4">
        <p class="text-muted-foreground">{{ $content }}</p>
    </div>
    <div class="mt-4 flex items-center">
        <x-public.rating :stars="$rating ?? 5" />
        <span class="ml-2 text-sm text-muted-foreground">{{ $date }}</span>
    </div>
</div>