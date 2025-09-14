<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" class="text-foreground" />
                <x-input id="email" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-foreground" />
                <x-input id="password" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-foreground" />
                <x-input id="password_confirmation" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>