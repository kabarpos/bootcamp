@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary/50 to-blue-600/50">
        <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Explore Our</span>
                    <span class="block mt-2 text-accent">Bootcamp Programs</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-white/90 sm:max-w-3xl">
                    Choose from our carefully designed bootcamp programs to start your journey in tech.
                </p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-card/80 backdrop-blur-sm border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between py-6">
                <div>
                    <h2 class="text-2xl font-bold text-foreground">All Bootcamps</h2>
                    <p class="mt-1 text-muted-foreground">Find the perfect program for your career goals</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex space-x-2">
                        <select class="block w-full pl-3 pr-10 py-2 text-base border border-border bg-card/50 text-foreground rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm backdrop-blur-sm">
                            <option>All Categories</option>
                            <option>Web Development</option>
                            <option>Data Science</option>
                            <option>Design</option>
                            <option>Mobile Development</option>
                        </select>
                        <select class="block w-full pl-3 pr-10 py-2 text-base border border-border bg-card/50 text-foreground rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm backdrop-blur-sm">
                            <option>All Levels</option>
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Advanced</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootcamps Grid -->
    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Bootcamp Card 1 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Web Development Bootcamp">
                    </div>
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    Web Development
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 backdrop-blur-sm">
                                    Beginner
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'full-stack-web-development') }}" class="block mt-4">
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
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'full-stack-web-development') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
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
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    Data Science
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 backdrop-blur-sm">
                                    Intermediate
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'data-science-ai') }}" class="block mt-4">
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
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'data-science-ai') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
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
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    Design
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 backdrop-blur-sm">
                                    Beginner
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'ux-ui-design') }}" class="block mt-4">
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
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'ux-ui-design') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Card 4 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Mobile Development Bootcamp">
                    </div>
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    Mobile Development
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 backdrop-blur-sm">
                                    Intermediate
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'mobile-development') }}" class="block mt-4">
                                <p class="text-xl font-semibold text-foreground">Mobile App Development</p>
                                <p class="mt-3 text-base text-muted-foreground">
                                    Build native mobile applications for iOS and Android platforms.
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    14 Weeks
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">
                                    Starting at $3,299
                                </p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'mobile-development') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Card 5 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Cybersecurity Bootcamp">
                    </div>
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    Cybersecurity
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 backdrop-blur-sm">
                                    Advanced
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'cybersecurity') }}" class="block mt-4">
                                <p class="text-xl font-semibold text-foreground">Cybersecurity</p>
                                <p class="mt-3 text-base text-muted-foreground">
                                    Protect systems and networks from digital attacks and threats.
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    18 Weeks
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">
                                    Starting at $3,999
                                </p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'cybersecurity') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Card 6 -->
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-card/80 backdrop-blur-sm border border-border bootcamp-card">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="DevOps Bootcamp">
                    </div>
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    DevOps
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 backdrop-blur-sm">
                                    Advanced
                                </span>
                            </div>
                            <a href="{{ route('public.bootcamp', 'devops') }}" class="block mt-4">
                                <p class="text-xl font-semibold text-foreground">DevOps Engineering</p>
                                <p class="mt-3 text-base text-muted-foreground">
                                    Bridge the gap between development and operations for efficient software delivery.
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary backdrop-blur-sm">
                                    15 Weeks
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">
                                    Starting at $3,799
                                </p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('public.bootcamp', 'devops') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer btn-primary backdrop-blur-sm">
                                View Details
                            </a>
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
                        <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 cursor-pointer backdrop-blur-sm bg-white/90">
                            Apply Now
                        </a>
                    </div>
                    <div class="ml-3 inline-flex rounded-md shadow">
                        <a href="{{ route('public.contact') }}" class="inline-flex items-center justify-center px-5 py-3 border border-white border-opacity-30 text-base font-medium rounded-md text-white bg-white/10 hover:bg-white/20 cursor-pointer backdrop-blur-sm">
                            Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection