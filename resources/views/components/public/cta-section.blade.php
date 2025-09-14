<!-- CTA Section -->
<div class="relative bg-gradient-to-r from-primary to-blue-600/80">
    <div class="max-w-7xl mx-auto py-12 px-4 text-center">
        <div class="backdrop-blur-sm bg-white/10 rounded-lg p-8 mx-auto">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">{{ $titleLine1 ?? 'Ready to start your journey?' }}</span>
                <span class="block text-accent">{{ $titleLine2 ?? 'Join our next bootcamp.' }}</span>
            </h2>
            <div class="mt-8 flex mx-auto max-w-screen-xl justify-center">
                <div class="inline-flex rounded-md shadow">
                    <x-public.button href="{{ $applyLink ?? '#' }}">
                        {{ $applyText ?? 'Apply Now' }}
                    </x-public.button>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <x-public.button href="{{ $contactLink ?? '#contact' }}" variant="secondary">
                        {{ $contactText ?? 'Contact Sales' }}
                    </x-public.button>
                </div>
            </div>
        </div>
    </div>
</div>