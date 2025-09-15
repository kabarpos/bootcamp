<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Batch;
use App\Models\Mentor;
use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Show the homepage for the public site.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get active bootcamps for the homepage
        $bootcamps = Bootcamp::with(['categories', 'batches'])
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        // Get published blog posts
        $blogPosts = BlogPost::with('author')
            ->published()
            ->latest()
            ->take(3)
            ->get();

        // Get team members (mentors)
        $teamMembers = Mentor::take(3)->get();

        return view('public.homepage', compact('bootcamps', 'blogPosts', 'teamMembers'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        // Get team members (mentors)
        $teamMembers = Mentor::all();
        
        // Get stats from settings
        $stats = [
            'graduates' => Setting::get('graduates_count', '5000+'),
            'placement_rate' => Setting::get('placement_rate', '95%'),
            'partners' => Setting::get('partners_count', '25+'),
            'mentors' => Setting::get('mentors_count', '100+'),
        ];

        return view('public.about', compact('teamMembers', 'stats'));
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        // Get contact info from settings
        $contactInfo = [
            'phone' => Setting::get('contact_phone', '+1 (555) 123-4567'),
            'email' => Setting::get('contact_email', 'info@bootcamp.com'),
            'address' => Setting::get('contact_address', '123 Tech Street, San Francisco, CA 94103'),
        ];

        return view('public.contact', compact('contactInfo'));
    }

    /**
     * Show the bootcamps page.
     *
     * @return \Illuminate\View\View
     */
    public function bootcamps()
    {
        // Get all active bootcamps
        $bootcamps = Bootcamp::with(['categories', 'batches'])
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('public.bootcamps', compact('bootcamps'));
    }

    /**
     * Show a specific bootcamp details page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function bootcamp($slug)
    {
        // Fetch the bootcamp by slug
        $bootcamp = Bootcamp::with(['categories', 'mentors', 'batches.city'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.bootcamp-details', compact('bootcamp'));
    }
    
    /**
     * Show the student dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get latest blog posts
        $blogPosts = BlogPost::with('author')
            ->published()
            ->latest()
            ->take(3)
            ->get();

        // Get upcoming events from settings or create sample data
        $upcomingEvents = [
            [
                'title' => Setting::get('event_1_title', 'Web Development Workshop'),
                'description' => Setting::get('event_1_description', 'Learn the latest web development techniques'),
                'date' => Setting::get('event_1_date', '2025-10-15'),
                'time' => Setting::get('event_1_time', '10:00 AM - 2:00 PM'),
            ],
            [
                'title' => Setting::get('event_2_title', 'Career Fair'),
                'description' => Setting::get('event_2_description', 'Meet potential employers and network'),
                'date' => Setting::get('event_2_date', '2025-10-22'),
                'time' => Setting::get('event_2_time', '2:00 PM - 6:00 PM'),
            ],
        ];

        return view('public.dashboard', compact('blogPosts', 'upcomingEvents'));
    }
    
    /**
     * Show the resources page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function resources($slug)
    {
        // Fetch the bootcamp by slug
        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get resources from settings or create sample data
        $resources = [
            [
                'type' => 'document',
                'title' => Setting::get('resource_1_title', 'HTML Cheat Sheet'),
                'description' => Setting::get('resource_1_description', 'Quick reference guide for HTML5 elements and attributes'),
                'size' => Setting::get('resource_1_size', '2.4 MB'),
                'actionText' => Setting::get('resource_1_action', 'Download PDF'),
                'link' => Setting::get('resource_1_link', '#'),
            ],
            [
                'type' => 'video',
                'title' => Setting::get('resource_2_title', 'CSS Flexbox Tutorial'),
                'description' => Setting::get('resource_2_description', 'Comprehensive video tutorial on CSS Flexbox layout'),
                'size' => Setting::get('resource_2_size', '45.2 MB'),
                'actionText' => Setting::get('resource_2_action', 'Watch Video'),
                'link' => Setting::get('resource_2_link', '#'),
            ],
            [
                'type' => 'link',
                'title' => Setting::get('resource_3_title', 'JavaScript Documentation'),
                'description' => Setting::get('resource_3_description', 'Official MDN documentation for JavaScript'),
                'size' => Setting::get('resource_3_size', 'Online Resource'),
                'actionText' => Setting::get('resource_3_action', 'Visit Site'),
                'link' => Setting::get('resource_3_link', '#'),
            ],
        ];

        return view('public.resources', compact('bootcamp', 'resources'));
    }
    
    /**
     * Show the assessments page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function assessments($slug)
    {
        // Fetch the bootcamp by slug
        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.assessments', compact('bootcamp'));
    }
    
    /**
     * Show the projects page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function projects($slug)
    {
        // Fetch the bootcamp by slug
        $bootcamp = Bootcamp::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.projects', compact('bootcamp'));
    }
}