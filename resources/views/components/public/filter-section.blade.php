<!-- Filter Section -->
<div class="bg-card/80 backdrop-blur-sm border-b border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between py-6">
            <div>
                <h2 class="text-2xl font-bold text-foreground">{{ $title ?? 'All Bootcamps' }}</h2>
                <p class="mt-1 text-muted-foreground">{{ $description ?? 'Find the perfect program for your career goals' }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex space-x-2">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>