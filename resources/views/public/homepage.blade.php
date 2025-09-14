@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary/50 to-blue-600/50">
        <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Master New Skills with</span>
                    <span class="block mt-2 text-accent">Our Bootcamp Programs</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-white/90 sm:max-w-3xl">
                    Join our intensive bootcamp programs and accelerate your career in tech. Learn from industry experts and build real-world projects.
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a href="#bootcamps" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 cursor-pointer backdrop-blur-sm bg-white/90">
                        Explore Bootcamps
                    </a>
                    <a href="#contact" class="px-8 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white/10 md:py-4 md:text-lg md:px-10 cursor-pointer backdrop-blur-sm bg-white/10">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Why Choose Us</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    The Best Learning Experience
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground mx-auto">
                    We provide everything you need to succeed in your tech career.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="pt-6">
                        <div class="flow-root bg-card/80 backdrop-blur-sm rounded-lg px-6 pb-8 border border-border shadow-lg">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-primary rounded-md shadow-lg">
                                        <!-- Heroicon name: outline/globe-alt -->
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 104 0 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-foreground tracking-tight">Expert Instructors</h3>
                                <p class="mt-5 text-base text-muted-foreground">
                                    Learn from industry professionals with years of real-world experience.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="pt-6">
                        <div class="flow-root bg-card/80 backdrop-blur-sm rounded-lg px-6 pb-8 border border-border shadow-lg">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-primary rounded-md shadow-lg">
                                        <!-- Heroicon name: outline/lightning-bolt -->
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-foreground tracking-tight">Hands-on Projects</h3>
                                <p class="mt-5 text-base text-muted-foreground">
                                    Build real-world projects that you can showcase in your portfolio.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="pt-6">
                        <div class="flow-root bg-card/80 backdrop-blur-sm rounded-lg px-6 pb-8 border border-border shadow-lg">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-primary rounded-md shadow-lg">
                                        <!-- Heroicon name: outline/briefcase -->
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-foreground tracking-tight">Career Support</h3>
                                <p class="mt-5 text-base text-muted-foreground">
                                    Get job placement assistance and career guidance after graduation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootcamps Section -->
    <div id="bootcamps" class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Our Programs</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    Available Bootcamps
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground mx-auto">
                    Choose from our carefully designed bootcamp programs.
                </p>
            </div>

            <!-- Placeholder for bootcamp listings -->
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Bootcamp Card 1 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Web Development Bootcamp">
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-primary">
                                    <a href="#" class="hover:underline cursor-pointer">Web Development</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-foreground">Full-Stack Web Development</p>
                                    <p class="mt-3 text-base text-muted-foreground">
                                        Master both frontend and backend technologies to become a complete web developer.
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                        12 Weeks
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-foreground">
                                        Starting at $2,999
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bootcamp Card 2 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1550439062-609e1531270e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Data Science Bootcamp">
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-primary">
                                    <a href="#" class="hover:underline cursor-pointer">Data Science</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-foreground">Data Science & AI</p>
                                    <p class="mt-3 text-base text-muted-foreground">
                                        Learn to analyze data, build machine learning models, and work with AI technologies.
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                        16 Weeks
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-foreground">
                                        Starting at $3,499
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bootcamp Card 3 -->
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1558369979-7a0e95b4e2d9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="UX/UI Design Bootcamp">
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-primary">
                                    <a href="#" class="hover:underline cursor-pointer">Design</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-foreground">UX/UI Design</p>
                                    <p class="mt-3 text-base text-muted-foreground">
                                        Create beautiful and functional user experiences with modern design principles.
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                        10 Weeks
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-foreground">
                                        Starting at $2,499
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-primary to-blue-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <div class="backdrop-blur-sm bg-white/10 rounded-lg p-8">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Ready to start your journey?</span>
                    <span class="block text-accent">Join our next bootcamp.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 cursor-pointer btn-primary backdrop-blur-sm bg-white/90">
                            Apply Now
                        </a>
                    </div>
                    <div class="ml-3 inline-flex rounded-md shadow">
                        <a href="#contact" class="inline-flex items-center justify-center px-5 py-3 border border-white border-opacity-30 text-base font-medium rounded-md text-white bg-white/10 hover:bg-white/20 cursor-pointer btn-primary backdrop-blur-sm">
                            Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Contact</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    Get in Touch
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    Have questions? We're here to help you begin your journey.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                    <div>
                        <form action="#" method="POST" class="grid grid-cols-1 gap-y-6 bg-card/80 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                            <div>
                                <label for="name" class="sr-only">Full name</label>
                                <input type="text" name="name" id="name" autocomplete="name" placeholder="Full name" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm">
                            </div>

                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input id="email" name="email" type="email" autocomplete="email" placeholder="Email" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm">
                            </div>

                            <div>
                                <label for="phone" class="sr-only">Phone</label>
                                <input type="text" name="phone" id="phone" autocomplete="tel" placeholder="Phone" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm">
                            </div>

                            <div>
                                <label for="message" class="sr-only">Message</label>
                                <textarea id="message" name="message" rows="4" placeholder="Message" class="block w-full shadow-sm py-3 px-4 placeholder-muted-foreground focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm"></textarea>
                            </div>

                            <div>
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-12 sm:mt-0">
                        <div class="h-full bg-card/80 rounded-lg shadow-lg p-6 border border-border backdrop-blur-sm">
                            <div class="h-full flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-foreground">Contact Information</h3>
                                    <p class="mt-2 text-muted-foreground">
                                        Fill out the form and we'll get back to you as soon as possible.
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
                                            <p>+1 (555) 123-4567</p>
                                            <p class="mt-1">Mon-Fri 9am to 5pm (EST)</p>
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
                                            <p>info@bootcamp.com</p>
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
                                            <p>123 Tech Street</p>
                                            <p>San Francisco, CA 94103</p>
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
</div>
@endsection