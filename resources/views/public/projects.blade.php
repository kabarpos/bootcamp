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
    ['label' => 'Projects', 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$title"
    titleLine2="Portfolio Projects"
    description="Build production-ready applications guided by mentors and present them to hiring partners."
    :stats="[
        ['label' => 'Capstones', 'value' => '3'],
        ['label' => 'Mini-sprints', 'value' => '6'],
        ['label' => 'Team collabs', 'value' => '2']
    ]"
/>

<x-public.projects-section>
    @if(isset($projects))
        @foreach($projects as $project)
            <x-public.project-card
                :title="$project['title']"
                :description="$project['description']"
                :technologies="$project['technologies']"
                :duration="$project['duration']"
                :status="$project['status']"
                :difficulty="$project['difficulty'] ?? null"
                :completedDate="$project['completedDate'] ?? null"
                :viewLink="$project['viewLink'] ?? null"
                :startLink="$project['startLink'] ?? null"
            />
        @endforeach
    @else
        <x-public.project-card title="Responsive Marketing Website" description="Design and develop a marketing page with responsive layouts and animations." technologies="Tailwind, Alpine.js" duration="2 weeks" status="completed" completedDate="May 12, 2023" viewLink="#" />
        <x-public.project-card title="SaaS Dashboard" description="Ship a dashboard with charts, filters, and role-based access control." technologies="Laravel, Livewire, MySQL" duration="3 weeks" status="in-progress" difficulty="Advanced" startLink="#" />
        <x-public.project-card title="Mobile Ordering App" description="Prototype a cross-platform ordering experience with offline support." technologies="React Native, Expo" duration="4 weeks" status="not-started" difficulty="Intermediate" startLink="#" />
        <x-public.project-card title="API Integration Service" description="Build a service that aggregates third-party APIs with queued processing." technologies="Node.js, Redis" duration="2 weeks" status="not-started" difficulty="Advanced" startLink="#" />
        <x-public.project-card title="Design System" description="Create a design system with reusable components and documentation." technologies="Figma, Storybook" duration="2 weeks" status="not-started" difficulty="Intermediate" startLink="#" />
        <x-public.project-card title="Capstone Showcase" description="Final presentation deck and live demo of your flagship project." technologies="Any" duration="2 weeks" status="not-started" difficulty="All levels" startLink="#" />
    @endif
</x-public.projects-section>
@endsection
