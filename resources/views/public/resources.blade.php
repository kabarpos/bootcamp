@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    @if(isset($bootcamp))
        <x-public.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('public.homepage')],
            ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
            ['label' => $bootcamp->title, 'url' => route('public.bootcamp', $bootcamp->slug)],
            ['label' => 'Resources', 'url' => '#']
        ]" />
    @else
        <x-public.breadcrumb :items="[
            ['label' => 'Home', 'url' => route('public.homepage')],
            ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
            ['label' => 'Web Development', 'url' => route('public.bootcamp', 'web-development')],
            ['label' => 'Resources', 'url' => '#']
        ]" />
    @endif
    
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                    @if(isset($bootcamp))
                        {{ $bootcamp->title }} Resources
                    @else
                        Web Development Resources
                    @endif
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-muted-foreground sm:mt-4">
                    Additional materials to support your learning
                </p>
            </div>
        </div>
    </div>
    
    <x-public.resources-section>
        @if(isset($resources))
            @foreach($resources as $resource)
                <x-public.resource-card
                    type="{{ $resource['type'] }}"
                    title="{{ $resource['title'] }}"
                    description="{{ $resource['description'] }}"
                    size="{{ $resource['size'] }}"
                    actionText="{{ $resource['actionText'] }}"
                    link="{{ $resource['link'] }}"
                />
            @endforeach
        @else
            <x-public.resource-card
                type="document"
                title="HTML Cheat Sheet"
                description="Quick reference guide for HTML5 elements and attributes"
                size="2.4 MB"
                actionText="Download PDF"
                link="#"
            />
            
            <x-public.resource-card
                type="video"
                title="CSS Flexbox Tutorial"
                description="Comprehensive video tutorial on CSS Flexbox layout"
                size="45.2 MB"
                actionText="Watch Video"
                link="#"
            />
            
            <x-public.resource-card
                type="link"
                title="JavaScript Documentation"
                description="Official MDN documentation for JavaScript"
                size="Online Resource"
                actionText="Visit Site"
                link="#"
            />
            
            <x-public.resource-card
                type="document"
                title="React Best Practices"
                description="Guide to writing clean and efficient React code"
                size="1.8 MB"
                actionText="Download PDF"
                link="#"
            />
            
            <x-public.resource-card
                type="video"
                title="Node.js Fundamentals"
                description="Introduction to server-side JavaScript with Node.js"
                size="62.7 MB"
                actionText="Watch Video"
                link="#"
            />
            
            <x-public.resource-card
                type="link"
                title="GitHub Repository"
                description="Course code examples and project templates"
                size="Online Resource"
                actionText="View Code"
                link="#"
            />
        @endif
    </x-public.resources-section>
</div>
@endsection