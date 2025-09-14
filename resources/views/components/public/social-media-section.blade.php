<div class="mt-6 bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
    <h3 class="text-lg font-medium text-foreground">{{ $title ?? 'Follow Us' }}</h3>
    <div class="mt-4 flex space-x-6">
        {{ $slot }}
    </div>
</div>