<nav x-data="{ mobileMenuOpen: false }" class="bg-card/80 backdrop-blur-sm border-b border-border sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('public.homepage') }}" class="text-xl font-bold text-primary">
                        Bootcamp
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('public.homepage') }}" class="{{ request()->routeIs('public.homepage') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:border-border hover:text-foreground' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        Home
                    </a>
                    <a href="{{ route('public.bootcamps') }}" class="{{ request()->routeIs('public.bootcamps') || request()->routeIs('public.bootcamp') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:border-border hover:text-foreground' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        Bootcamps
                    </a>
                    <a href="{{ route('public.about') }}" class="{{ request()->routeIs('public.about') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:border-border hover:text-foreground' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        About
                    </a>
                    <a href="{{ route('public.contact') }}" class="{{ request()->routeIs('public.contact') ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:border-border hover:text-foreground' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-300">
                        Contact
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <a href="{{ route('login') }}" class="text-muted-foreground hover:text-foreground px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer transition-colors duration-300">
                    Sign up
                </a>
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-accent focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary transition-colors duration-300" aria-controls="mobile-menu" :aria-expanded="mobileMenuOpen">
                    <span class="sr-only">Open main menu</span>
                    <!-- Heroicon name: outline/menu -->
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" x-transition class="sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('public.homepage') }}" class="{{ request()->routeIs('public.homepage') ? 'bg-accent border-primary text-foreground' : 'border-transparent text-muted-foreground hover:bg-accent hover:border-border hover:text-foreground' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                Home
            </a>
            <a href="{{ route('public.bootcamps') }}" class="{{ request()->routeIs('public.bootcamps') || request()->routeIs('public.bootcamp') ? 'bg-accent border-primary text-foreground' : 'border-transparent text-muted-foreground hover:bg-accent hover:border-border hover:text-foreground' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                Bootcamps
            </a>
            <a href="{{ route('public.about') }}" class="{{ request()->routeIs('public.about') ? 'bg-accent border-primary text-foreground' : 'border-transparent text-muted-foreground hover:bg-accent hover:border-border hover:text-foreground' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                About
            </a>
            <a href="{{ route('public.contact') }}" class="{{ request()->routeIs('public.contact') ? 'bg-accent border-primary text-foreground' : 'border-transparent text-muted-foreground hover:bg-accent hover:border-border hover:text-foreground' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors duration-300">
                Contact
            </a>
            <div class="border-t border-border pt-4 pb-3">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <a href="{{ route('login') }}" class="text-muted-foreground hover:text-foreground px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                            Log in
                        </a>
                    </div>
                    <div class="ml-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer transition-colors duration-300">
                            Sign up
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>