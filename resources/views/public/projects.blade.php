@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
        ['label' => 'Web Development', 'url' => route('public.bootcamp', 'web-development')],
        ['label' => 'Projects', 'url' => '#']
    ]" />
    
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                    Web Development Projects
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-muted-foreground sm:mt-4">
                    Build real-world applications to showcase your skills
                </p>
            </div>
        </div>
    </div>
    
    <x-public.projects-section>
        <x-public.project-card
            title="Personal Portfolio Website"
            description="Create a responsive portfolio website to showcase your work"
            technologies="HTML, CSS, JavaScript"
            duration="1 week"
            status="completed"
            completedDate="June 10, 2023"
            viewLink="#"
        />
        
        <x-public.project-card
            title="Task Management App"
            description="Build a full-featured task management application with CRUD operations"
            technologies="React, Node.js, MongoDB"
            duration="2 weeks"
            status="in-progress"
            difficulty="Intermediate"
            startLink="#"
        />
        
        <x-public.project-card
            title="E-commerce Website"
            description="Develop a complete e-commerce platform with payment integration"
            technologies="React, Node.js, Express, MongoDB"
            duration="3 weeks"
            status="not-started"
            difficulty="Advanced"
            startLink="#"
        />
        
        <x-public.project-card
            title="Social Media Dashboard"
            description="Create a dashboard to manage social media accounts and analytics"
            technologies="React, Redux, REST API"
            duration="2 weeks"
            status="not-started"
            difficulty="Intermediate"
            startLink="#"
        />
        
        <x-public.project-card
            title="Weather App"
            description="Build a weather application with real-time data and forecasts"
            technologies="JavaScript, REST API"
            duration="1 week"
            status="not-started"
            difficulty="Beginner"
            startLink="#"
        />
        
        <x-public.project-card
            title="Capstone Project"
            description="Develop a full-stack application of your choice to demonstrate mastery"
            technologies="Any technologies from the course"
            duration="4 weeks"
            status="not-started"
            difficulty="Expert"
            startLink="#"
        />
    </x-public.projects-section>
</div>
@endsection