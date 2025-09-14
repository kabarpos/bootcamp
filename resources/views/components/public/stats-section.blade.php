<!-- Stats Section -->
<div class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                {{ $title ?? 'By the numbers' }}
            </h2>
            <p class="mt-3 text-xl text-muted-foreground sm:mt-4">
                {{ $description ?? 'Our impact in numbers that matter.' }}
            </p>
        </div>
    </div>
    <div class="mt-10 bg-gradient-to-r from-primary/80 to-blue-600/80 backdrop-blur-sm rounded-lg mx-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>