<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-muted-foreground">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" class="text-foreground" />
                <x-input id="email" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-muted-foreground hover:text-foreground cursor-pointer">
                Back to login
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>