@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
        ['label' => ucfirst(str_replace('-', ' ', $slug)), 'url' => '#']
    ]" />
    
    <x-public.hero-section 
        titleLine1="{{ ucfirst(str_replace('-', ' ', $slug)) }}"
        titleLine2="Bootcamp Program"
        description="An intensive program designed to transform you into a professional in just a few weeks."
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
                <x-public.program-detail-item 
                    label="Duration"
                    value="12 Weeks"
                />
                
                <x-public.program-detail-item 
                    label="Format"
                    value="Full-time, In-person"
                    class="border-t border-border"
                />
                
                <x-public.program-detail-item 
                    label="Prerequisites"
                    value="Basic computer skills"
                    class="border-t border-border"
                />
                
                <x-public.program-detail-item 
                    label="Certification"
                    value="Yes"
                    class="border-t border-border"
                />
                
                <x-public.program-detail-item 
                    label="Cost"
                    value="$2,999"
                    valueClass="text-sm font-bold text-foreground"
                    class="border-t border-border"
                />
                
                <x-public.program-detail-item 
                    label="Next Start Date"
                    value="January 15, 2026"
                    class="border-t border-border"
                />
            </x-public.program-details>
        </x-public.program-overview-card>
    </x-public.program-overview-section>
    
    <x-public.syllabus-section>
        <x-public.syllabus-module title="Module 1: Fundamentals (Weeks 1-2)">
            <x-public.syllabus-item content="Introduction to programming concepts" />
            <x-public.syllabus-item content="HTML/CSS basics" />
            <x-public.syllabus-item content="JavaScript fundamentals" />
            <x-public.syllabus-item content="Version control with Git" />
        </x-public.syllabus-module>
        
        <x-public.syllabus-module title="Module 2: Frontend Development (Weeks 3-5)">
            <x-public.syllabus-item content="Advanced JavaScript and ES6+" />
            <x-public.syllabus-item content="React.js framework" />
            <x-public.syllabus-item content="State management" />
            <x-public.syllabus-item content="Responsive design principles" />
        </x-public.syllabus-module>
        
        <x-public.syllabus-module title="Module 3: Backend Development (Weeks 6-8)">
            <x-public.syllabus-item content="Node.js and Express" />
            <x-public.syllabus-item content="Database design with MongoDB" />
            <x-public.syllabus-item content="RESTful API development" />
            <x-public.syllabus-item content="Authentication and security" />
        </x-public.syllabus-module>
        
        <x-public.syllabus-module title="Module 4: Advanced Topics (Weeks 9-10)">
            <x-public.syllabus-item content="Testing with Jest" />
            <x-public.syllabus-item content="Deployment and DevOps" />
            <x-public.syllabus-item content="Performance optimization" />
            <x-public.syllabus-item content="Project planning and management" />
        </x-public.syllabus-module>
        
        <x-public.syllabus-module title="Module 5: Capstone Project (Weeks 11-12)">
            <x-public.syllabus-item content="Project ideation and planning" />
            <x-public.syllabus-item content="Full-stack application development" />
            <x-public.syllabus-item content="Presentation and portfolio preparation" />
            <x-public.syllabus-item content="Job search and interview preparation" />
        </x-public.syllabus-module>
    </x-public.syllabus-section>
    
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center space-x-4 flex-wrap">
                <x-public.button href="{{ route('public.resources', $slug) }}" variant="secondary" class="mb-2">
                    View Additional Resources
                </x-public.button>
                <x-public.button href="{{ route('public.assessments', $slug) }}" variant="secondary" class="mb-2">
                    View Assessments
                </x-public.button>
                <x-public.button href="{{ route('public.projects', $slug) }}" variant="secondary" class="mb-2">
                    View Projects
                </x-public.button>
            </div>
        </div>
    </div>
    
    <x-public.instructor-section 
        image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Alex Johnson"
        position="Senior Software Engineer at TechCorp"
        bio1="Alex has over 12 years of experience in web development and has worked with companies like Google, Microsoft, and several startups. He specializes in full-stack development and has led teams of developers on complex projects."
        bio2="As an instructor, Alex focuses on practical skills and real-world applications. His teaching style is engaging and ensures that students understand both the how and why of development practices."
    >
        <x-slot name="rating">
            <x-public.rating stars="5" />
        </x-slot>
        <x-slot name="reviews">4.9/5 from 128 reviews</x-slot>
    </x-public.instructor-section>
    
    <x-public.testimonials-section>
        <x-public.testimonial-card
            image="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Jessica Miller"
            position="Frontend Developer"
            content="This bootcamp completely changed my career trajectory. The instructors were incredibly knowledgeable and supportive throughout the entire process."
            rating="5"
            date="3 months ago"
        />
        
        <x-public.testimonial-card
            image="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Marcus Williams"
            position="Full-Stack Developer"
            content="The hands-on projects were invaluable. I was able to showcase my work during interviews and demonstrate my skills to potential employers."
            rating="5"
            date="1 month ago"
        />
        
        <x-public.testimonial-card
            image="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Sophia Chen"
            position="UX Designer"
            content="The career services team helped me prepare for interviews and connected me with potential employers. I couldn't have asked for better support."
            rating="5"
            date="2 weeks ago"
        />
    </x-public.testimonials-section>
    
    <x-public.pricing-section>
        <x-public.pricing-card
            title="Upfront Payment"
            price="$2,999"
            description="Pay in full and save $300"
        >
            <x-public.pricing-feature feature="Full access to all course materials" />
            <x-public.pricing-feature feature="Career services included" />
            <x-public.pricing-feature feature="Job placement assistance" />
        </x-public.pricing-card>
        
        <x-public.pricing-card
            title="Payment Plan"
            price="$199"
            frequency="month"
            description="Flexible monthly payments"
            featured="true"
        >
            <x-public.pricing-feature feature="Full access to all course materials" />
            <x-public.pricing-feature feature="Career services included" />
            <x-public.pricing-feature feature="Job placement assistance" />
            <x-public.pricing-feature feature="0% interest financing" />
        </x-public.pricing-card>
        
        <x-public.pricing-card
            title="ISA"
            price="15% of income"
            frequency="for 2 years"
            description="Income Share Agreement"
        >
            <x-public.pricing-feature feature="Full access to all course materials" />
            <x-public.pricing-feature feature="Career services included" />
            <x-public.pricing-feature feature="Job placement assistance" />
            <x-public.pricing-feature feature="Payment only after employment" />
        </x-public.pricing-card>
    </x-public.pricing-section>
    
    <x-public.cta-section />
</div>
@endsection