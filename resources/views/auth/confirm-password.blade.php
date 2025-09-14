<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-muted-foreground">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" class="text-foreground" />
                <x-input id="password" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ms-4 bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>