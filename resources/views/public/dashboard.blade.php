@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-foreground sm:text-4xl">
                    Welcome back, <span class="text-primary">Sarah</span>
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-muted-foreground sm:mt-4">
                    Continue your learning journey
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-public.course-module
                            title="HTML & CSS Fundamentals"
                            duration="2 weeks"
                            description="Learn the building blocks of web development with modern HTML5 and CSS3."
                            lessons="12"
                            progress="100"
                            progressLabel="Completed"
                            actionText="Review"
                        />
                        
                        <x-public.course-module
                            title="JavaScript Essentials"
                            duration="3 weeks"
                            description="Master JavaScript fundamentals including variables, functions, and DOM manipulation."
                            lessons="18"
                            progress="75"
                            progressLabel="In Progress"
                            actionText="Continue"
                        />
                        
                        <x-public.course-module
                            title="React Framework"
                            duration="4 weeks"
                            description="Build dynamic user interfaces with the popular React library."
                            lessons="24"
                            progress="0"
                            progressLabel="Not Started"
                            actionText="Start"
                        />
                    </div>
                </div>
                
                <div>
                    <x-public.progress-summary
                        title="Overall Progress"
                        percentage="60"
                        label="60% Complete"
                        completed="12"
                        remaining="8"
                        buttonText="Continue Learning"
                    />
                </div>
            </div>
        </div>
    </div>
    
    <x-public.milestones-section>
        <x-public.milestone-card
            title="Enrollment Complete"
            description="Successfully enrolled in the Web Development Bootcamp"
            date="June 1, 2023"
            status="completed"
        />
        
        <x-public.milestone-card
            title="First Project Submission"
            description="Submitted your first portfolio website project"
            date="June 10, 2023"
            status="completed"
        />
        
        <x-public.milestone-card
            title="Mid-term Assessment"
            description="Complete the JavaScript fundamentals quiz"
            date="June 20, 2023"
            status="in-progress"
        />
        
        <x-public.milestone-card
            title="Internship Opportunity"
            description="Apply for internship positions with our partners"
            date="July 15, 2023"
            status="pending"
        />
        
        <x-public.milestone-card
            title="Capstone Project"
            description="Develop and present your final project"
            date="August 1, 2023"
            status="pending"
        />
        
        <x-public.milestone-card
            title="Graduation"
            description="Complete all requirements and receive your certificate"
            date="August 15, 2023"
            status="pending"
        />
    </x-public.milestones-section>
    
    <x-public.leaderboard-section>
        <x-public.leaderboard-item
            position="1"
            avatar="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Alex Johnson"
            bootcamp="Web Development"
            points="1250"
        />
        
        <x-public.leaderboard-item
            position="2"
            avatar="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Sarah Miller"
            bootcamp="Web Development"
            points="1180"
        />
        
        <x-public.leaderboard-item
            position="3"
            avatar="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Michael Chen"
            bootcamp="Web Development"
            points="1120"
        />
        
        <x-public.leaderboard-item
            position="4"
            avatar="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="Emily Davis"
            bootcamp="Web Development"
            points="1090"
        />
        
        <x-public.leaderboard-item
            position="5"
            avatar="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            name="You (Sarah)"
            bootcamp="Web Development"
            points="1050"
        />
    </x-public.leaderboard-section>
    
    <x-public.announcements-section>
        <x-public.announcement-card
            title="New Course Materials Available"
            postedAt="2 days ago"
            content="We've added new video tutorials and coding exercises for the React module. Check them out in your course resources."
            link="#"
            linkText="View Resources"
        />
        
        <x-public.announcement-card
            title="Upcoming Maintenance"
            postedAt="1 week ago"
            content="Our learning platform will be undergoing maintenance this Saturday from 2 AM to 4 AM EST. Please plan accordingly."
        />
        
        <x-public.announcement-card
            title="Career Services Update"
            postedAt="2 weeks ago"
            content="Our career services team has partnered with 5 new companies for job placements. Schedule a meeting with a career advisor today."
            link="#"
            linkText="Book Appointment"
        />
    </x-public.announcements-section>
    
    <x-public.upcoming-events>
        <x-public.upcoming-event
            day="15"
            month="Jun"
            title="JavaScript Quiz"
            description="Test your knowledge of JavaScript fundamentals"
            time="2:00 PM - 3:00 PM"
        />
        
        <x-public.upcoming-event
            day="18"
            month="Jun"
            title="React Project Review"
            description="Submit your React project for feedback"
            time="10:00 AM - 11:00 AM"
        />
        
        <x-public.upcoming-event
            day="22"
            month="Jun"
            title="Live Q&A Session"
            description="Join our instructors for a live Q&A session"
            time="4:00 PM - 5:00 PM"
        />
    </x-public.upcoming-events>

    <x-public.roadmap-section>
        <x-public.roadmap-item
            title="HTML & CSS Fundamentals"
            description="Master the building blocks of web development"
            duration="2 weeks"
            lessons="12"
            status="completed"
        />
        
        <x-public.roadmap-item
            title="JavaScript Essentials"
            description="Learn core JavaScript concepts and techniques"
            duration="3 weeks"
            lessons="18"
            status="in-progress"
            link="#"
        />
        
        <x-public.roadmap-item
            title="React Framework"
            description="Build dynamic user interfaces with React"
            duration="4 weeks"
            lessons="24"
            status="not-started"
            link="#"
        />
        
        <x-public.roadmap-item
            title="Backend Development"
            description="Learn server-side programming with Node.js"
            duration="5 weeks"
            lessons="20"
            status="not-started"
            link="#"
        />
        
        <x-public.roadmap-item
            title="Database Management"
            description="Master database design and management with MongoDB"
            duration="3 weeks"
            lessons="15"
            status="not-started"
            link="#"
        />
        
        <x-public.roadmap-item
            title="Capstone Project"
            description="Build a full-stack application to showcase your skills"
            duration="4 weeks"
            lessons="10"
            status="not-started"
            link="#"
        />
    </x-public.roadmap-section>
    
    <x-public.certificates-section>
        <x-public.certificate-card
            title="HTML & CSS Fundamentals"
            description="Completed the foundational course in web development"
            status="completed"
            duration="2 weeks"
            completedDate="June 15, 2023"
            downloadLink="#"
        />
        
        <x-public.certificate-card
            title="JavaScript Essentials"
            description="Mastered core JavaScript concepts and techniques"
            status="in-progress"
            duration="3 weeks"
            progress="75"
            progressLabel="75% Complete"
            continueLink="#"
        />
        
        <x-public.certificate-card
            title="React Framework"
            description="Learned to build dynamic user interfaces"
            status="not-started"
            duration="4 weeks"
            actionText="Start Course"
            continueLink="#"
        />
    </x-public.certificates-section>
    
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
@endsection