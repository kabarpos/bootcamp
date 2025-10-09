@extends('layouts.public')

@section('content')
@php
    $currentBootcamp = $bootcamp ?? null;
    $title = $currentBootcamp->title ?? ucfirst(str_replace('-', ' ', $slug ?? 'Bootcamp'));
    $shortDescription = $currentBootcamp->short_desc ?? 'An intensive program designed to transform you into a professional in just a few weeks.';
    $durationLabel = $currentBootcamp?->duration_hours ? $currentBootcamp->duration_hours . ' hours' : '12 weeks';
    $modeLabel = $currentBootcamp?->mode ? ucfirst($currentBootcamp->mode) : 'Hybrid';
    $levelLabel = $currentBootcamp?->level ? ucfirst($currentBootcamp->level) : 'All levels';
    $priceLabel = $currentBootcamp?->base_price ? 'Rp ' . number_format($currentBootcamp->base_price, 0, ',', '.') : 'Rp 12.500.000';
    $heroStats = [
        ['label' => 'Duration', 'value' => $durationLabel],
        ['label' => 'Bootcamp Mode', 'value' => $modeLabel],
        ['label' => 'Level', 'value' => $levelLabel],
    ];
@endphp

<x-public.breadcrumb :items="[
    ['label' => 'Home', 'url' => route('public.homepage')],
    ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
    ['label' => $title, 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$title"
    titleLine2="Bootcamp Program"
    :description="$shortDescription"
    :stats="$heroStats"
/>

<x-public.program-overview-section>
    <x-public.program-overview-card title="Curriculum Highlights">
        <x-public.checklist>
            <x-public.checklist-item content="Hands-on projects with real-world applications" />
            <x-public.checklist-item content="Mentorship from industry professionals" />
            <x-public.checklist-item content="Career services and job placement assistance" />
            <x-public.checklist-item content="Access to our alumni network" />
            <x-public.checklist-item content="Lifetime access to course materials" />
        </x-public.checklist>
    </x-public.program-overview-card>

    <x-public.program-overview-card title="Program Details">
        <x-public.program-details>
            <x-public.program-detail-item label="Duration" :value="$durationLabel" />
            <x-public.program-detail-item label="Mode" :value="$modeLabel" />
            <x-public.program-detail-item label="Level" :value="$levelLabel" />
            <x-public.program-detail-item label="Prerequisites" value="Basic computer skills" />
            <x-public.program-detail-item label="Certification" value="Yes" />
            <x-public.program-detail-item label="Investment" :value="$priceLabel" />
            <x-public.program-detail-item label="Categories" :value="$currentBootcamp?->categories->pluck('name')->implode(', ') ?? 'Product, Engineering'" />
        </x-public.program-details>
    </x-public.program-overview-card>
</x-public.program-overview-section>

<x-public.syllabus-section>
    <x-public.syllabus-module title="Module 1: Foundations">
        <x-public.syllabus-item content="HTML & Semantic structure" />
        <x-public.syllabus-item content="Responsive design principles" />
        <x-public.syllabus-item content="CSS utility frameworks" />
    </x-public.syllabus-module>
    <x-public.syllabus-module title="Module 2: Frontend Engineering">
        <x-public.syllabus-item content="Modern JavaScript (ES2025)" />
        <x-public.syllabus-item content="Component-driven development" />
        <x-public.syllabus-item content="State management patterns" />
    </x-public.syllabus-module>
    <x-public.syllabus-module title="Module 3: Backend APIs">
        <x-public.syllabus-item content="RESTful design" />
        <x-public.syllabus-item content="Database modeling" />
        <x-public.syllabus-item content="Authentication & security" />
    </x-public.syllabus-module>
    <x-public.syllabus-module title="Module 4: DevOps & Deployment">
        <x-public.syllabus-item content="CI/CD pipelines" />
        <x-public.syllabus-item content="Cloud infrastructure essentials" />
        <x-public.syllabus-item content="Observability & SLOs" />
    </x-public.syllabus-module>
</x-public.syllabus-section>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3">
            <x-public.button :href="$currentBootcamp ? route('public.resources', $currentBootcamp->slug) : route('public.resources', $slug ?? 'resources')" variant="secondary">
                View Additional Resources
            </x-public.button>
            <x-public.button :href="$currentBootcamp ? route('public.assessments', $currentBootcamp->slug) : route('public.assessments', $slug ?? 'assessments')" variant="secondary">
                View Assessments
            </x-public.button>
            <x-public.button :href="$currentBootcamp ? route('public.projects', $currentBootcamp->slug) : route('public.projects', $slug ?? 'projects')" variant="secondary">
                View Projects
            </x-public.button>
        </div>
    </div>
</section>

<x-public.instructor-section 
    image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
    name="Alex Johnson"
    position="Senior Software Engineer at TechCorp"
    bio1="Alex has over 12 years of experience in web development and has worked with companies like Google, Microsoft, and several startups."
    bio2="As an instructor, Alex focuses on practical skills and real-world applications to ensure you master both fundamentals and advanced techniques."
>
    <x-slot name="rating">
        <x-public.rating stars="5" />
    </x-slot>
    <x-slot name="reviews">4.9/5 from 128 reviews</x-slot>
</x-public.instructor-section>

<x-public.testimonials-section>
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Jessica Miller"
        position="Frontend Developer"
        content="This bootcamp completely changed my career trajectory. The instructors were incredibly knowledgeable and supportive throughout the entire process."
        rating="5"
        date="3 months ago"
    />
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Marcus Williams"
        position="Full-Stack Developer"
        content="The hands-on projects were invaluable. I was able to showcase my work during interviews and demonstrate my skills to potential employers."
        rating="5"
        date="1 month ago"
    />
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Sophia Chen"
        position="UX Designer"
        content="The career services team helped me prepare for interviews and connected me with potential employers. I couldn't have asked for better support."
        rating="5"
        date="2 weeks ago"
    />
</x-public.testimonials-section>

<x-public.cta-section />
@endsection
