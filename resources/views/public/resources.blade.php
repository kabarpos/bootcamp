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
    ['label' => 'Resources', 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$title"
    titleLine2="Resource Library"
    description="Extra materials curated by mentors to help you reinforce concepts between live sessions."
    :stats="[
        ['label' => 'Guides & templates', 'value' => '24+'],
        ['label' => 'Video walkthroughs', 'value' => '12'],
        ['label' => 'Toolkits', 'value' => '8']
    ]"
/>

<x-public.resources-section>
    @if(isset($resources))
        @foreach($resources as $resource)
            <x-public.resource-card
                :type="$resource['type']"
                :title="$resource['title']"
                :description="$resource['description']"
                :size="$resource['size']"
                :actionText="$resource['actionText']"
                :link="$resource['link']"
            />
        @endforeach
    @else
        <x-public.resource-card type="document" title="HTML Cheat Sheet" description="Quick reference guide for HTML5 elements and attributes" size="2.4 MB" actionText="Download PDF" link="#" />
        <x-public.resource-card type="video" title="CSS Flexbox Tutorial" description="Comprehensive video tutorial on CSS Flexbox layout" size="45.2 MB" actionText="Watch Video" link="#" />
        <x-public.resource-card type="link" title="JavaScript Documentation" description="Official MDN documentation for JavaScript" size="Online Resource" actionText="Visit Site" link="#" />
        <x-public.resource-card type="document" title="React Best Practices" description="Guide to writing clean and efficient React code" size="1.8 MB" actionText="Download PDF" link="#" />
        <x-public.resource-card type="video" title="Node.js Fundamentals" description="Introduction to server-side JavaScript with Node.js" size="62.7 MB" actionText="Watch Video" link="#" />
        <x-public.resource-card type="link" title="GitHub Repository" description="Course code examples and project templates" size="Online Resource" actionText="View Code" link="#" />
    @endif
</x-public.resources-section>
@endsection
