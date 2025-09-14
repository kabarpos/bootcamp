@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary/70 to-blue-600/80">
        <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">About Our</span>
                    <span class="block mt-2 text-accent">Bootcamp Program</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-white/90 sm:max-w-3xl">
                    We're passionate about transforming careers through intensive, hands-on learning experiences.
                </p>
            </div>
        </div>
    </div>

    <!-- About Content -->
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Our Story</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    Transforming Careers Since 2015
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    We started with a simple mission: to make tech education accessible and effective for everyone.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <h3 class="text-lg font-medium text-foreground">Our Mission</h3>
                        <p class="mt-4 text-muted-foreground">
                            Our mission is to bridge the gap between traditional education and industry needs by providing 
                            intensive, practical training that prepares our students for real-world challenges. We believe 
                            that anyone can learn to code or design with the right guidance and dedication.
                        </p>
                        <p class="mt-4 text-muted-foreground">
                            We focus on creating an environment where students can thrive through hands-on projects, 
                            mentorship from industry professionals, and a supportive community of peers.
                        </p>
                    </div>
                    <div class="bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <h3 class="text-lg font-medium text-foreground">Our Approach</h3>
                        <p class="mt-4 text-muted-foreground">
                            We've developed a unique approach to learning that emphasizes practical skills over theoretical 
                            knowledge. Our curriculum is constantly updated to reflect the latest industry trends and 
                            technologies.
                        </p>
                        <p class="mt-4 text-muted-foreground">
                            Our bootcamps are intensive but designed to accommodate different learning styles. We provide 
                            personalized attention to ensure each student succeeds in their journey.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                    By the numbers
                </h2>
                <p class="mt-3 text-xl text-muted-foreground sm:mt-4">
                    Our impact in numbers that matter.
                </p>
            </div>
        </div>
        <div class="mt-10 bg-gradient-to-r from-primary/80 to-blue-600/80 backdrop-blur-sm rounded-lg mx-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                    <div class="text-center">
                        <p class="text-5xl font-extrabold text-white">5000+</p>
                        <p class="mt-2 text-base font-medium text-white/90">Graduates</p>
                    </div>
                    <div class="text-center">
                        <p class="text-5xl font-extrabold text-white">95%</p>
                        <p class="mt-2 text-base font-medium text-white/90">Job Placement Rate</p>
                    </div>
                    <div class="text-center">
                        <p class="text-5xl font-extrabold text-white">25+</p>
                        <p class="mt-2 text-base font-medium text-white/90">Hiring Partners</p>
                    </div>
                    <div class="text-center">
                        <p class="text-5xl font-extrabold text-white">100+</p>
                        <p class="mt-2 text-base font-medium text-white/90">Mentors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base font-semibold text-primary tracking-wide uppercase">Our Team</h2>
                <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
                    Meet Our Leadership
                </p>
                <p class="mt-4 max-w-2xl text-xl text-muted-foreground lg:mx-auto">
                    Passionate educators and industry experts driving our mission forward.
                </p>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Team Member 1 -->
                    <div class="flex flex-col items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <img class="w-32 h-32 rounded-full object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="CEO">
                        <div class="mt-6 text-center">
                            <h3 class="text-lg font-medium text-foreground">John Smith</h3>
                            <p class="text-base text-primary">CEO & Founder</p>
                            <p class="mt-2 text-muted-foreground">
                                Former software engineer at Google with 15+ years of industry experience.
                            </p>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="flex flex-col items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <img class="w-32 h-32 rounded-full object-cover" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="CTO">
                        <div class="mt-6 text-center">
                            <h3 class="text-lg font-medium text-foreground">Michael Rodriguez</h3>
                            <p class="text-base text-primary">CTO</p>
                            <p class="mt-2 text-muted-foreground">
                                Full-stack developer and curriculum architect with expertise in modern web technologies.
                            </p>
                        </div>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="flex flex-col items-center bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
                        <img class="w-32 h-32 rounded-full object-cover" src="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Head of Education">
                        <div class="mt-6 text-center">
                            <h3 class="text-lg font-medium text-foreground">Sarah Johnson</h3>
                            <p class="text-base text-primary">Head of Education</p>
                            <p class="mt-2 text-muted-foreground">
                                Educational psychologist with a passion for creating effective learning experiences.
                            </p>
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