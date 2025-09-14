<!-- Team Member -->
<div class="flex flex-col items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
    <img class="w-32 h-32 rounded-full object-cover" src="{{ $image }}" alt="{{ $name }}">
    <div class="mt-6 text-center">
        <h3 class="text-lg font-medium text-foreground">{{ $name }}</h3>
        <p class="text-base text-primary">{{ $position }}</p>
        <p class="mt-2 text-muted-foreground">
            {{ $bio }}
        </p>
    </div>
</div>