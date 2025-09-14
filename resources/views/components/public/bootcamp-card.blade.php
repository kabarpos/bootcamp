<div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
    <div class="flex-shrink-0">
        <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $alt }}">
    </div>
    <div class="flex-1 p-6 flex flex-col justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-primary">
                <a href="{{ $categoryLink }}" class="hover:underline cursor-pointer">{{ $category }}</a>
            </p>
            <a href="{{ $titleLink }}" class="block mt-2">
                <p class="text-xl font-semibold text-foreground">{{ $title }}</p>
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
    </div>
</div>