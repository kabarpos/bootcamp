@extends('layouts.public')

@section('content')
    <x-public.hero-section />
    
    <x-public.features-section>
        <x-public.feature-card title="Expert Instructors" description="Learn from industry professionals with years of real-world experience.">
            <x-slot name="icon">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 104 0 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot>
        </x-public.feature-card>
        
        <x-public.feature-card title="Hands-on Projects" description="Build real-world projects that you can showcase in your portfolio.">
            <x-slot name="icon">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </x-slot>
        </x-public.feature-card>
        
        <x-public.feature-card title="Career Support" description="Get job placement assistance and career guidance after graduation.">
            <x-slot name="icon">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </x-slot>
        </x-public.feature-card>
    </x-public.features-section>
    
    <x-public.bootcamps-section>
        <x-public.bootcamp-card 
            image="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
            alt="Web Development Bootcamp"
            category="Web Development"
            categoryLink="#"
            title="Full-Stack Web Development"
            titleLink="#"
            description="Master both frontend and backend technologies to become a complete web developer."
            duration="12 Weeks"
            price="Starting at $2,999"
        />
        
        <x-public.bootcamp-card 
            image="https://images.unsplash.com/photo-1550439062-609e1531270e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
            alt="Data Science Bootcamp"
            category="Data Science"
            categoryLink="#"
            title="Data Science & AI"
            titleLink="#"
            description="Learn to analyze data, build machine learning models, and work with AI technologies."
            duration="16 Weeks"
            price="Starting at $3,499"
        />
        
        <x-public.bootcamp-card 
            image="https://images.unsplash.com/photo-1558369979-7a0e95b4e2d9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
            alt="UX/UI Design Bootcamp"
            category="Design"
            categoryLink="#"
            title="UX/UI Design"
            titleLink="#"
            description="Create beautiful and functional user experiences with modern design principles."
            duration="10 Weeks"
            price="Starting at $2,499"
        />
    </x-public.bootcamps-section>
    
    <x-public.cta-section />
    <x-public.contact-section />
@endsection