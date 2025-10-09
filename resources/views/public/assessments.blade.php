@extends('layouts.public')

@section('content')
@php
    $currentBootcamp = $bootcamp ?? null;
    $title = $currentBootcamp->title ?? 'Web Development';
@endphp

<x-public.breadcrumb :items="[
    ['label' => 'Home', 'url' => route('public.homepage')],
    ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
    ['label' => $title, 'url' => $currentBootcamp ? route('public.bootcamp', $currentBootcamp->slug) : route('public.bootcamp', 'web-development')],
    ['label' => 'Assessments', 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$title"
    titleLine2="Progress Assessments"
    description="Measure retention with adaptive quizzes and track improvement after every sprint."
    :stats="[
        ['label' => 'Quizzes available', 'value' => '18'],
        ['label' => 'Average score', 'value' => '87%'],
        ['label' => 'Attempts remaining', 'value' => '3']
    ]"
/>

<x-public.quizzes-section>
    @if(isset($quizzes))
        @foreach($quizzes as $quiz)
            <x-public.quiz-card
                :title="$quiz['title']"
                :description="$quiz['description']"
                :questions="$quiz['questions']"
                :duration="$quiz['duration']"
                :status="$quiz['status']"
                :score="$quiz['score'] ?? null"
                :completedDate="$quiz['completedDate'] ?? null"
                :attempts="$quiz['attempts'] ?? null"
                :reviewLink="$quiz['reviewLink'] ?? null"
                :startLink="$quiz['startLink'] ?? null"
            />
        @endforeach
    @else
        <x-public.quiz-card title="HTML Fundamentals Quiz" description="Test your knowledge of HTML5 elements and structure" questions="20" duration="20 minutes" status="completed" score="95" completedDate="June 15, 2023" reviewLink="#" />
        <x-public.quiz-card title="CSS Layout Quiz" description="Assess your understanding of CSS layout techniques" questions="15" duration="15 minutes" status="in-progress" attempts="2" startLink="#" />
        <x-public.quiz-card title="JavaScript Basics Quiz" description="Evaluate your grasp of JavaScript fundamentals" questions="25" duration="30 minutes" status="not-started" attempts="3" startLink="#" />
        <x-public.quiz-card title="React Components Quiz" description="Test your knowledge of React components and props" questions="18" duration="25 minutes" status="not-started" attempts="3" startLink="#" />
        <x-public.quiz-card title="Node.js Fundamentals Quiz" description="Assess your understanding of server-side JavaScript" questions="22" duration="30 minutes" status="not-started" attempts="3" startLink="#" />
        <x-public.quiz-card title="Final Capstone Project" description="Comprehensive assessment of all course material" questions="N/A" duration="2 hours" status="not-started" attempts="1" startLink="#" />
    @endif
</x-public.quizzes-section>
@endsection
