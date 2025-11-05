@extends('layouts.public')

@section('content')
<x-public.hero-section 
    titleLine1="About Our"
    titleLine2="Bootcamp Program"
    description="We're passionate about transforming careers through intensive, hands-on learning experiences."
    variant="list"
    :showImage="false"
/>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            subtitle="Our Story"
            title="Transforming Careers Since 2015"
            description="We started with a simple mission: to make tech education accessible and effective for everyone."
            align="left"
            maxWidth="max-w-2xl"
        />
        
        <div class="mt-14 grid grid-cols-1 gap-8 lg:grid-cols-2">
            <x-public.program-overview-card title="Our Mission">
                <p class="text-sm text-slate-300">
                    Our mission is to bridge the gap between traditional education and industry needs by providing 
                    intensive, practical training that prepares our students for real-world challenges. We believe 
                    that anyone can learn to code or design with the right guidance and dedication.
                </p>
                <p class="text-sm text-slate-300">
                    We focus on creating an environment where students can thrive through hands-on projects, 
                    mentorship from industry professionals, and a supportive community of peers.
                </p>
            </x-public.program-overview-card>
            
            <x-public.program-overview-card title="Our Approach">
                <p class="text-sm text-slate-300">
                    We've developed a unique approach to learning that emphasizes practical skills over theoretical 
                    knowledge. Our curriculum is constantly updated to reflect the latest industry trends and 
                    technologies.
                </p>
                <p class="text-sm text-slate-300">
                    Our bootcamps are intensive but designed to accommodate different learning styles. We provide 
                    personalized attention to ensure each student succeeds in their journey.
                </p>
            </x-public.program-overview-card>
        </div>
    </div>
</section>

<x-public.stats-section>
    <x-public.stats-card number="{{ $stats['graduates'] }}" label="Graduates" />
    <x-public.stats-card number="{{ $stats['placement_rate'] }}" label="Job Placement Rate" />
    <x-public.stats-card number="{{ $stats['partners'] }}" label="Hiring Partners" />
    <x-public.stats-card number="{{ $stats['mentors'] }}" label="Mentors" />
</x-public.stats-section>

<x-public.team-section>
    @if(isset($teamMembers) && $teamMembers->count() > 0)
        @foreach($teamMembers as $member)
            <x-public.team-member 
                image="{{ $member->photo_url ?? 'https://images.unsplash.com/photo-' . rand(1, 9) . '?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                name="{{ $member->name }}"
                position="{{ $member->headline ?? 'Team Member' }}"
                bio="{{ $member->bio ?? 'Experienced professional in the tech industry.' }}"
            />
        @endforeach
    @else
        {{-- Fallback to static data --}}
        <x-public.team-member 
            image="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="John Smith"
            position="CEO & Founder"
            bio="Former software engineer at Google with 15+ years of industry experience."
        />
        
        <x-public.team-member 
            image="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Michael Rodriguez"
            position="CTO"
            bio="Full-stack developer and curriculum architect with expertise in modern web technologies."
        />
        
        <x-public.team-member 
            image="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Sarah Johnson"
            position="Head of Education"
            bio="Educational psychologist with a passion for creating effective learning experiences."
        />
    @endif
</x-public.team-section>

<x-public.testimonials-section>
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="David Wilson"
        position="Software Engineer"
        content="The bootcamp was intense but incredibly rewarding. The instructors were knowledgeable and supportive throughout the entire journey."
        rating="5"
        date="6 months ago"
    />
    
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Lisa Thompson"
        position="Product Manager"
        content="I transitioned from marketing to tech thanks to this bootcamp. The career services team was instrumental in helping me land my dream job."
        rating="5"
        date="4 months ago"
    />
    
    <x-public.testimonial-card
        image="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        name="Robert Garcia"
        position="DevOps Engineer"
        content="The hands-on projects were invaluable. I was able to showcase my work during interviews and demonstrate my skills to potential employers."
        rating="5"
        date="2 months ago"
    />
</x-public.testimonials-section>

<x-public.cta-section />
@endsection
