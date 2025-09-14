<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-foreground" />
                <x-input id="email" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-foreground" />
                <x-input id="password" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-muted-foreground">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-muted-foreground">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary/90 cursor-pointer">
                    Sign up
                </a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>