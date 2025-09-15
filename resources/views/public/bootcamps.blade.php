@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.hero-section 
        titleLine1="Explore Our"
        titleLine2="Bootcamp Programs"
        description="Choose from our carefully designed bootcamp programs to start your journey in tech."
    />
    
    <x-public.filter-section>
        <x-public.select-filter placeholder="All Categories">
            <x-public.filter-option label="Web Development" />
            <x-public.filter-option label="Data Science" />
            <x-public.filter-option label="Design" />
            <x-public.filter-option label="Mobile Development" />
        </x-public.select-filter>
        
        <x-public.select-filter placeholder="All Levels">
            <x-public.filter-option label="Beginner" />
            <x-public.filter-option label="Intermediate" />
            <x-public.filter-option label="Advanced" />
        </x-public.select-filter>
    </x-public.filter-section>
    
    <!-- Bootcamps Grid -->
    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($bootcamps))
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($bootcamps as $bootcamp)
                        <x-public.bootcamp-card 
                            image="https://images.unsplash.com/photo-{{ rand(1, 6) }}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                            alt="{{ $bootcamp->title }}"
                            category="{{ $bootcamp->categories->first()->name ?? 'Web Development' }}"
                            categoryLink="#"
                            title="{{ $bootcamp->title }}"
                            titleLink="{{ route('public.bootcamp', $bootcamp->slug) }}"
                            description="{{ $bootcamp->short_desc }}"
                            duration="{{ $bootcamp->duration_hours }} hours"
                            price="Starting at Rp {{ number_format($bootcamp->base_price, 0, ',', '.') }}"
                            level="{{ ucfirst($bootcamp->level) }}"
                        />
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if(method_exists($bootcamps, 'links'))
                    <div class="mt-8">
                        {{ $bootcamps->links() }}
                    </div>
                @endif
            @else
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @for($i = 0; $i < 6; $i++)
                        <x-public.bootcamp-card 
                            image="https://images.unsplash.com/photo-{{ $i == 0 ? '1555066931-4365d14bab8c' : ($i == 1 ? '1550439062-609e1531270e' : ($i == 2 ? '1558369979-7a0e95b4e2d9' : ($i == 3 ? '1547658719-da2b51169166' : ($i == 4 ? '1551650975-87deedd944c3' : '1553877522-43269d4ea984')))) }}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                            alt="{{ $i == 0 ? 'Web Development Bootcamp' : ($i == 1 ? 'Data Science Bootcamp' : ($i == 2 ? 'UX/UI Design Bootcamp' : ($i == 3 ? 'Mobile Development Bootcamp' : ($i == 4 ? 'Cybersecurity Bootcamp' : 'DevOps Bootcamp')))) }}"
                            category="{{ $i == 0 ? 'Web Development' : ($i == 1 ? 'Data Science' : ($i == 2 ? 'Design' : ($i == 3 ? 'Mobile Development' : ($i == 4 ? 'Cybersecurity' : 'DevOps')))) }}"
                            categoryLink="#"
                            title="{{ $i == 0 ? 'Full-Stack Web Development' : ($i == 1 ? 'Data Science & AI' : ($i == 2 ? 'UX/UI Design' : ($i == 3 ? 'Mobile App Development' : ($i == 4 ? 'Cybersecurity' : 'DevOps Engineering')))) }}"
                            titleLink="{{ route('public.bootcamp', $i == 0 ? 'full-stack-web-development' : ($i == 1 ? 'data-science-ai' : ($i == 2 ? 'ux-ui-design' : ($i == 3 ? 'mobile-development' : ($i == 4 ? 'cybersecurity' : 'devops'))))) }}"
                            description="{{ $i == 0 ? 'Master both frontend and backend technologies to become a complete web developer.' : ($i == 1 ? 'Learn to analyze data, build machine learning models, and work with AI technologies.' : ($i == 2 ? 'Create beautiful and functional user experiences with modern design principles.' : ($i == 3 ? 'Build native mobile applications for iOS and Android platforms.' : ($i == 4 ? 'Protect systems and networks from digital attacks and threats.' : 'Bridge the gap between development and operations for efficient software delivery.')))) }}"
                            duration="{{ $i == 0 ? '12 Weeks' : ($i == 1 ? '16 Weeks' : ($i == 2 ? '10 Weeks' : ($i == 3 ? '14 Weeks' : ($i == 4 ? '18 Weeks' : '15 Weeks')))) }}"
                            price="{{ $i == 0 ? 'Starting at $2,999' : ($i == 1 ? 'Starting at $3,499' : ($i == 2 ? 'Starting at $2,499' : ($i == 3 ? 'Starting at $3,299' : ($i == 4 ? 'Starting at $3,999' : 'Starting at $3,799')))) }}"
                            level="{{ $i == 0 ? 'Beginner' : ($i == 1 ? 'Intermediate' : ($i == 2 ? 'Beginner' : ($i == 3 ? 'Intermediate' : ($i == 4 ? 'Advanced' : 'Advanced')))) }}"
                        />
                    @endfor
                </div>
            @endif
        </div>
    </div>
    
    <x-public.pricing-section>
        <x-public.pricing-card
            title="Part-Time"
            price="$1,499"
            frequency="month"
            description="Flexible schedule for working professionals"
        >
            <x-public.pricing-feature feature="20 weeks of part-time study" />
            <x-public.pricing-feature feature="Access to online resources" />
            <x-public.pricing-feature feature="Community support" />
        </x-public.pricing-card>
        
        <x-public.pricing-card
            title="Full-Time"
            price="$2,999"
            description="Intensive 12-week program"
            featured="true"
        >
            <x-public.pricing-feature feature="12 weeks of intensive training" />
            <x-public.pricing-feature feature="Hands-on projects" />
            <x-public.pricing-feature feature="Career services" />
            <x-public.pricing-feature feature="Mentorship program" />
        </x-public.pricing-card>
        
        <x-public.pricing-card
            title="Premium"
            price="$3,999"
            description="Complete bootcamp experience"
        >
            <x-public.pricing-feature feature="16 weeks of advanced training" />
            <x-public.pricing-feature feature="One-on-one mentoring" />
            <x-public.pricing-feature feature="Job placement assistance" />
            <x-public.pricing-feature feature="Lifetime career support" />
        </x-public.pricing-card>
    </x-public.pricing-section>
    
    <x-public.cta-section />
</div>
@endsection