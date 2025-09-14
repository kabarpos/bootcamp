<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" class="text-foreground" />
                <x-input id="name" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" class="text-foreground" />
                <x-input id="email" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-foreground" />
                <x-input id="password" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-foreground" />
                <x-input id="password_confirmation" class="block mt-1 w-full bg-background/50 border border-input rounded-lg focus:border-primary focus:ring focus:ring-primary/30" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4 bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-muted-foreground">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/90 cursor-pointer">
                    Sign in
                </a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>