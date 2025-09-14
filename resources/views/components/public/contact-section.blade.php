<!-- Contact Section -->
<div id="contact" class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="{{ $subtitle ?? 'Contact' }}"
            title="{{ $title ?? 'Get in Touch' }}"
            description="{{ $description ?? 'Have questions? We\'re here to help you begin your journey.' }}"
        />
        
        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div>
                    <form action="{{ $formAction ?? '#' }}" method="POST" class="grid grid-cols-1 gap-y-6 bg-card/80 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        @csrf
                        <div>
                            <label for="name" class="sr-only">Full name</label>
                            <input type="text" name="name" id="name" autocomplete="name" placeholder="{{ $namePlaceholder ?? 'Full name' }}" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm" required>
                        </div>

                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" placeholder="{{ $emailPlaceholder ?? 'Email' }}" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm" required>
                        </div>

                        <div>
                            <label for="phone" class="sr-only">Phone</label>
                            <input type="text" name="phone" id="phone" autocomplete="tel" placeholder="{{ $phonePlaceholder ?? 'Phone' }}" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm">
                        </div>

                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <textarea id="message" name="message" rows="4" placeholder="{{ $messagePlaceholder ?? 'Message' }}" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm" required></textarea>
                        </div>

                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                {{ $submitText ?? 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-12 sm:mt-0">
                    <div class="h-full bg-card/80 rounded-lg shadow-lg p-6 border border-border backdrop-blur-sm">
                        <div class="h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-foreground">{{ $infoTitle ?? 'Contact Information' }}</h3>
                                <p class="mt-2 text-muted-foreground">
                                    {{ $infoDescription ?? 'Fill out the form and we\'ll get back to you as soon as possible.' }}
                                </p>
                            </div>
                            <div class="mt-8">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/phone -->
                                        <svg class="h-6 w-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-muted-foreground">
                                        <p>{{ $phone ?? '+1 (555) 123-4567' }}</p>
                                        <p class="mt-1">{{ $phoneHours ?? 'Mon-Fri 9am to 5pm (EST)' }}</p>
                                    </div>
                                </div>
                                <div class="mt-6 flex items-start">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/mail -->
                                        <svg class="h-6 w-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-muted-foreground">
                                        <p>{{ $email ?? 'info@bootcamp.com' }}</p>
                                    </div>
                                </div>
                                <div class="mt-6 flex items-start">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/location-marker -->
                                        <svg class="h-6 w-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-muted-foreground">
                                        <p>{{ $addressLine1 ?? '123 Tech Street' }}</p>
                                        <p>{{ $addressLine2 ?? 'San Francisco, CA 94103' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>