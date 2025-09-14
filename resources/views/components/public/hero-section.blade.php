<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-primary to-blue-600/80">
    <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                <span class="block">{{ $titleLine1 ?? 'Master New Skills with' }}</span>
                <span class="block mt-2 text-accent">{{ $titleLine2 ?? 'Our Bootcamp Programs' }}</span>
            </h1>
            <p class="mt-6 max-w-lg mx-auto text-xl text-white/90 sm:max-w-3xl">
                {{ $description ?? 'Join our intensive bootcamp programs and accelerate your career in tech. Learn from industry experts and build real-world projects.' }}
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <x-public.button href="{{ $exploreLink ?? '#bootcamps' }}">
                    {{ $exploreText ?? 'Explore Bootcamps' }}
                </x-public.button>
                <x-public.button href="{{ $contactLink ?? '#contact' }}" variant="secondary">
                    {{ $contactText ?? 'Contact Us' }}
                </x-public.button>
            </div>
        </div>
    </div>
</div>