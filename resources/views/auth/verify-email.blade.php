<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('public.homepage') }}" class="text-2xl font-bold text-primary">
                Bootcamp
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-muted-foreground">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button class="bg-primary hover:bg-primary/90 text-primary-foreground focus:ring-primary/50">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <div class="flex flex-col sm:flex-row gap-2">
                <a
                    href="{{ route('profile.show') }}"
                    class="text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer"
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="text-sm text-muted-foreground hover:text-foreground rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary ms-0 sm:ms-2 cursor-pointer">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>