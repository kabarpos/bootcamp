@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary/70 to-blue-600/80">
        <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">{{ ucfirst(str_replace('-', ' ', $slug)) }}</span>
                    <span class="block mt-2 text-accent">Bootcamp Program</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-white/90 sm:max-w-3xl">
                    An intensive program designed to transform you into a professional in just a few weeks.
                </p>
            </div>
        </div>
    </div>

    <!-- Program Overview -->
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Program Overview</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    What You'll Learn
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    A comprehensive curriculum designed by industry experts to give you the skills employers want.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <h3 class="text-lg font-medium text-foreground">Curriculum Highlights</h3>
                        <div class="mt-6">
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/check-circle -->
                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-base text-muted-foreground">Hands-on projects with real-world applications</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-base text-muted-foreground">Mentorship from industry professionals</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-base text-muted-foreground">Career services and job placement assistance</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-base text-muted-foreground">Access to our alumni network</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-base text-muted-foreground">Lifetime access to course materials</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <h3 class="text-lg font-medium text-foreground">Program Details</h3>
                        <div class="mt-6 bg-card/50 backdrop-blur-sm rounded-lg shadow p-6 border border-border">
                            <div class="flow-root">
                                <div class="flex items-center justify-between py-3">
                                    <dt class="text-sm font-medium text-foreground">Duration</dt>
                                    <dd class="text-sm text-muted-foreground">12 Weeks</dd>
                                </div>
                                <div class="flex items-center justify-between py-3 border-t border-border">
                                    <dt class="text-sm font-medium text-foreground">Format</dt>
                                    <dd class="text-sm text-muted-foreground">Full-time, In-person</dd>
                                </div>
                                <div class="flex items-center justify-between py-3 border-t border-border">
                                    <dt class="text-sm font-medium text-foreground">Prerequisites</dt>
                                    <dd class="text-sm text-muted-foreground">Basic computer skills</dd>
                                </div>
                                <div class="flex items-center justify-between py-3 border-t border-border">
                                    <dt class="text-sm font-medium text-foreground">Certification</dt>
                                    <dd class="text-sm text-muted-foreground">Yes</dd>
                                </div>
                                <div class="flex items-center justify-between py-3 border-t border-border">
                                    <dt class="text-sm font-medium text-foreground">Cost</dt>
                                    <dd class="text-sm font-bold text-foreground">$2,999</dd>
                                </div>
                                <div class="flex items-center justify-between py-3 border-t border-border">
                                    <dt class="text-sm font-medium text-foreground">Next Start Date</dt>
                                    <dd class="text-sm text-muted-foreground">January 15, 2026</dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Syllabus Section -->
    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Curriculum</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    What You'll Learn
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    Our comprehensive curriculum covers everything you need to know to succeed in your new career.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10">
                    <!-- Module 1 -->
                    <div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
                        <div class="px-6 py-4 border-b border-border">
                            <h3 class="text-lg font-medium text-foreground">Module 1: Fundamentals (Weeks 1-2)</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
                                <li>Introduction to programming concepts</li>
                                <li>HTML/CSS basics</li>
                                <li>JavaScript fundamentals</li>
                                <li>Version control with Git</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 2 -->
                    <div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
                        <div class="px-6 py-4 border-b border-border">
                            <h3 class="text-lg font-medium text-foreground">Module 2: Frontend Development (Weeks 3-5)</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
                                <li>Advanced JavaScript and ES6+</li>
                                <li>React.js framework</li>
                                <li>State management</li>
                                <li>Responsive design principles</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 3 -->
                    <div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
                        <div class="px-6 py-4 border-b border-border">
                            <h3 class="text-lg font-medium text-foreground">Module 3: Backend Development (Weeks 6-8)</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
                                <li>Node.js and Express</li>
                                <li>Database design with MongoDB</li>
                                <li>RESTful API development</li>
                                <li>Authentication and security</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 4 -->
                    <div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
                        <div class="px-6 py-4 border-b border-border">
                            <h3 class="text-lg font-medium text-foreground">Module 4: Advanced Topics (Weeks 9-10)</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
                                <li>Testing with Jest</li>
                                <li>Deployment and DevOps</li>
                                <li>Performance optimization</li>
                                <li>Project planning and management</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 5 -->
                    <div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
                        <div class="px-6 py-4 border-b border-border">
                            <h3 class="text-lg font-medium text-foreground">Module 5: Capstone Project (Weeks 11-12)</h3>
                        </div>
                        <div class="px-6 py-4">
                            <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
                                <li>Project ideation and planning</li>
                                <li>Full-stack application development</li>
                                <li>Presentation and portfolio preparation</li>
                                <li>Job search and interview preparation</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructor Section -->
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Meet Your Instructor</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    Industry Expert
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    Learn from someone who has been in the industry for over a decade.
                </p>
            </div>

            <div class="mt-10">
                <div class="flex flex-col md:flex-row items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                    <div class="md:w-1/3 flex justify-center">
                        <img class="w-64 h-64 rounded-full object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Instructor">
                    </div>
                    <div class="mt-8 md:mt-0 md:w-2/3 md:pl-12">
                        <h3 class="text-2xl font-bold text-foreground">Alex Johnson</h3>
                        <p class="mt-2 text-primary">Senior Software Engineer at TechCorp</p>
                        <p class="mt-4 text-muted-foreground">
                            Alex has over 12 years of experience in web development and has worked with companies like 
                            Google, Microsoft, and several startups. He specializes in full-stack development and has 
                            led teams of developers on complex projects.
                        </p>
                        <p class="mt-4 text-muted-foreground">
                            As an instructor, Alex focuses on practical skills and real-world applications. His teaching 
                            style is engaging and ensures that students understand both the how and why of development 
                            practices.
                        </p>
                        <div class="mt-6">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-2 text-sm text-muted-foreground">4.9/5 from 128 reviews</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <x-public.cta-section />
</div>
@endsection