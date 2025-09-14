@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
        ['label' => 'Web Development', 'url' => route('public.bootcamp', 'web-development')],
        ['label' => 'Assessments', 'url' => '#']
    ]" />
    
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                    Web Development Assessments
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-muted-foreground sm:mt-4">
                    Test your knowledge and track your progress
                </p>
            </div>
        </div>
    </div>
    
    <x-public.quizzes-section>
        <x-public.quiz-card
            title="HTML Fundamentals Quiz"
            description="Test your knowledge of HTML5 elements and structure"
            questions="20"
            duration="20 minutes"
            status="completed"
            score="95"
            completedDate="June 15, 2023"
            reviewLink="#"
        />
        
        <x-public.quiz-card
            title="CSS Layout Quiz"
            description="Assess your understanding of CSS layout techniques"
            questions="15"
            duration="15 minutes"
            status="in-progress"
            attempts="2"
            startLink="#"
        />
        
        <x-public.quiz-card
            title="JavaScript Basics Quiz"
            description="Evaluate your grasp of JavaScript fundamentals"
            questions="25"
            duration="30 minutes"
            status="not-started"
            attempts="3"
            startLink="#"
        />
        
        <x-public.quiz-card
            title="React Components Quiz"
            description="Test your knowledge of React components and props"
            questions="18"
            duration="25 minutes"
            status="not-started"
            attempts="3"
            startLink="#"
        />
        
        <x-public.quiz-card
            title="Node.js Fundamentals Quiz"
            description="Assess your understanding of server-side JavaScript"
            questions="22"
            duration="30 minutes"
            status="not-started"
            attempts="3"
            startLink="#"
        />
        
        <x-public.quiz-card
            title="Final Capstone Project"
            description="Comprehensive assessment of all course material"
            questions="N/A"
            duration="2 hours"
            status="not-started"
            attempts="1"
            startLink="#"
        />
    </x-public.quizzes-section>
</div>
@endsection