@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.hero-section 
        titleLine1="Student"
        titleLine2="Dashboard"
        description="Welcome back! Here's what's happening with your learning journey."
    />
    
    <!-- Dashboard Content -->
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Progress Section -->
                <div class="lg:col-span-2">
                    <x-public.section-title 
                        subtitle="Your Progress"
                        title="Learning Journey"
                        description="Track your progress through the bootcamp curriculum."
                    />
                    
                    <div class="mt-8 space-y-6">
                        <x-public.progress-card 
                            title="Web Development Fundamentals"
                            progress="75"
                            status="In Progress"
                        />
                        
                        <x-public.progress-card 
                            title="Frontend Frameworks"
                            progress="40"
                            status="In Progress"
                        />
                        
                        <x-public.progress-card 
                            title="Backend Development"
                            progress="0"
                            status="Not Started"
                        />
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Upcoming Events -->
                    <x-public.upcoming-events-section>
                        @if(isset($upcomingEvents))
                            @foreach($upcomingEvents as $event)
                                @php
                                    $date = new DateTime($event['date']);
                                @endphp
                                <x-public.upcoming-event
                                    day="{{ $date->format('d') }}"
                                    month="{{ $date->format('M') }}"
                                    title="{{ $event['title'] }}"
                                    description="{{ $event['description'] }}"
                                    time="{{ $event['time'] }}"
                                />
                            @endforeach
                        @else
                            <x-public.upcoming-event
                                day="15"
                                month="OCT"
                                title="Web Development Workshop"
                                description="Learn the latest web development techniques"
                                time="10:00 AM - 2:00 PM"
                            />
                            
                            <x-public.upcoming-event
                                day="22"
                                month="OCT"
                                title="Career Fair"
                                description="Meet potential employers and network"
                                time="2:00 PM - 6:00 PM"
                            />
                        @endif
                    </x-public.upcoming-events-section>
                    
                    <!-- Announcements -->
                    <x-public.announcements-section>
                        <x-public.announcement-card
                            title="New Course Materials Available"
                            postedAt="2 hours ago"
                            content="We've added new React hooks exercises to the curriculum. Check them out in the resources section."
                        />
                        
                        <x-public.announcement-card
                            title="Career Services Update"
                            postedAt="1 day ago"
                            content="Our career services team has partnered with 5 new companies for job placements."
                            link="#"
                            linkText="View details"
                        />
                    </x-public.announcements-section>
                </div>
            </div>
            
            <!-- Blog Posts Section -->
            <div class="mt-16">
                <x-public.section-title 
                    subtitle="Latest News"
                    title="From the Blog"
                    description="Stay updated with the latest articles and tutorials."
                />
                
                <div class="mt-10">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @if(isset($blogPosts) && $blogPosts->count() > 0)
                            @foreach($blogPosts as $post)
                                <x-public.blog-post-card
                                    image="https://images.unsplash.com/photo-{{ rand(1, 9) }}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                                    title="{{ $post->title }}"
                                    excerpt="{{ $post->excerpt }}"
                                    author="{{ $post->author->name ?? 'Admin' }}"
                                    date="{{ $post->published_at->format('M d, Y') }}"
                                    link="{{ route('public.blog.post', $post->slug) }}"
                                />
                            @endforeach
                        @else
                            <x-public.blog-post-card
                                image="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                                title="Getting Started with JavaScript"
                                excerpt="Learn the fundamentals of JavaScript programming language."
                                author="Alex Johnson"
                                date="Sep 10, 2025"
                                link="#"
                            />
                            
                            <x-public.blog-post-card
                                image="https://images.unsplash.com/photo-1550439062-609e1531270e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                                title="CSS Best Practices"
                                excerpt="Discover the best practices for writing maintainable CSS."
                                author="Sarah Miller"
                                date="Sep 5, 2025"
                                link="#"
                            />
                            
                            <x-public.blog-post-card
                                image="https://images.unsplash.com/photo-1558369979-7a0e95b4e2d9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                                title="Building REST APIs"
                                excerpt="A guide to building secure and scalable REST APIs."
                                author="Michael Chen"
                                date="Aug 28, 2025"
                                link="#"
                            />
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Forum Section -->
            <div class="mt-16">
                <x-public.section-title 
                    subtitle="Community"
                    title="Discussion Forum"
                    description="Connect with fellow students and instructors."
                />
                
                <x-public.forum-section>
                    <x-public.forum-post
                        avatar="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        author="Alex Johnson"
                        category="JavaScript"
                        postedAt="2 hours ago"
                        title="Understanding Closures in JavaScript"
                        excerpt="I'm having trouble understanding how closures work in JavaScript. Can someone explain..."
                        replies="12"
                        likes="24"
                    />
                    
                    <x-public.forum-post
                        avatar="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        author="Sarah Miller"
                        category="React"
                        postedAt="5 hours ago"
                        title="Best Practices for State Management"
                        excerpt="What are the best practices for managing state in a large React application?..."
                        replies="8"
                        likes="17"
                    />
                    
                    <x-public.forum-post
                        avatar="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        author="Michael Chen"
                        category="CSS"
                        postedAt="1 day ago"
                        title="CSS Grid vs Flexbox"
                        excerpt="When should I use CSS Grid versus Flexbox for layout? What are the key differences?..."
                        replies="15"
                        likes="32"
                    />
                </x-public.forum-section>
            </div>
        </div>
    </div>
    
    <x-public.cta-section />
</div>
@endsection