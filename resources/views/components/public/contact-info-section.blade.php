<!-- Contact Info Section -->
<div class="space-y-8 lg:col-span-1">
    <div class="bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
        <h3 class="text-lg font-medium text-foreground">{{ $title ?? 'Contact Information' }}</h3>
        <p class="mt-2 text-muted-foreground">
            {{ $description ?? 'Fill out the form and we\'ll get back to you as soon as possible.' }}
        </p>
    </div>
    {{ $slot }}
</div>