<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Repositories\Contracts\BlogPostRepositoryInterface;
use App\Repositories\Contracts\BootcampRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class PublicController extends Controller
{
    public function __construct(
        private readonly BootcampRepositoryInterface $bootcampRepository,
        private readonly BlogPostRepositoryInterface $blogPostRepository,
        private readonly SettingRepositoryInterface $settingRepository,
        private readonly EnrollmentRepositoryInterface $enrollmentRepository,
        private readonly OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function index()
    {
        $bootcamps = $this->bootcampRepository->getActiveWithRelations(['categories', 'batches'], 3);
        $blogPosts = $this->blogPostRepository->getPublished(3, ['author']);
        $teamMembers = Mentor::take(3)->get();

        return view('public.homepage', compact('bootcamps', 'blogPosts', 'teamMembers'));
    }

    public function about()
    {
        $teamMembers = Mentor::all();

        $settings = $this->settingRepository->getValues([
            'graduates_count',
            'placement_rate',
            'partners_count',
            'mentors_count',
        ]);

        $stats = [
            'graduates' => $settings['graduates_count'] ?? '5000+',
            'placement_rate' => $settings['placement_rate'] ?? '95%',
            'partners' => $settings['partners_count'] ?? '25+',
            'mentors' => $settings['mentors_count'] ?? '100+',
        ];

        return view('public.about', compact('teamMembers', 'stats'));
    }

    public function contact()
    {
        $settings = $this->settingRepository->getValues([
            'contact_phone',
            'contact_email',
            'contact_address',
        ]);

        $contactInfo = [
            'phone' => $settings['contact_phone'] ?? '+1 (555) 123-4567',
            'email' => $settings['contact_email'] ?? 'info@bootcamp.com',
            'address' => $settings['contact_address'] ?? '123 Tech Street, San Francisco, CA 94103',
        ];

        return view('public.contact', compact('contactInfo'));
    }

    public function bootcamps()
    {
        $bootcamps = $this->bootcampRepository->paginateActive(9, ['categories', 'batches']);

        return view('public.bootcamps', compact('bootcamps'));
    }

    public function bootcamp($slug)
    {
        $bootcamp = $this->bootcampRepository->findActiveBySlug($slug, ['categories', 'mentors', 'batches.city']);

        return view('public.bootcamp-details', compact('bootcamp'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        $blogPosts = $this->blogPostRepository->getPublished(3, ['author']);

        $settings = $this->settingRepository->getValues([
            'event_1_title', 'event_1_description', 'event_1_date', 'event_1_time',
            'event_2_title', 'event_2_description', 'event_2_date', 'event_2_time',
        ]);

        $upcomingEvents = new Collection([
            [
                'title' => $settings['event_1_title'] ?? 'Web Development Workshop',
                'description' => $settings['event_1_description'] ?? 'Learn the latest web development techniques',
                'date' => $settings['event_1_date'] ?? '2025-10-15',
                'time' => $settings['event_1_time'] ?? '10:00 AM - 2:00 PM',
            ],
            [
                'title' => $settings['event_2_title'] ?? 'Career Fair',
                'description' => $settings['event_2_description'] ?? 'Meet potential employers and network',
                'date' => $settings['event_2_date'] ?? '2025-10-22',
                'time' => $settings['event_2_time'] ?? '2:00 PM - 6:00 PM',
            ],
        ]);

        $stats = [
            'enrollments' => $this->enrollmentRepository->countForUser($user->id),
            'certificates' => $this->enrollmentRepository->countCertificatesForUser($user->id),
            'total_spent' => $this->orderRepository->sumPaidTotalForUser($user->id),
        ];

        $recentEnrollments = $this->enrollmentRepository->getRecentForUser($user->id, 6);

        return view('public.dashboard', [
            'blogPosts' => $blogPosts,
            'upcomingEvents' => $upcomingEvents,
            'stats' => $stats,
            'recentEnrollments' => $recentEnrollments,
        ]);
    }

    public function resources($slug)
    {
        $bootcamp = $this->bootcampRepository->findActiveBySlug($slug);

        $settings = $this->settingRepository->getValues([
            'resource_1_title', 'resource_1_description', 'resource_1_size', 'resource_1_action', 'resource_1_link',
            'resource_2_title', 'resource_2_description', 'resource_2_size', 'resource_2_action', 'resource_2_link',
            'resource_3_title', 'resource_3_description', 'resource_3_size', 'resource_3_action', 'resource_3_link',
        ]);

        $resources = [
            [
                'type' => 'document',
                'title' => $settings['resource_1_title'] ?? 'HTML Cheat Sheet',
                'description' => $settings['resource_1_description'] ?? 'Quick reference guide for HTML5 elements and attributes',
                'size' => $settings['resource_1_size'] ?? '2.4 MB',
                'actionText' => $settings['resource_1_action'] ?? 'Download PDF',
                'link' => $settings['resource_1_link'] ?? '#',
            ],
            [
                'type' => 'video',
                'title' => $settings['resource_2_title'] ?? 'CSS Flexbox Tutorial',
                'description' => $settings['resource_2_description'] ?? 'Comprehensive video tutorial on CSS Flexbox layout',
                'size' => $settings['resource_2_size'] ?? '45.2 MB',
                'actionText' => $settings['resource_2_action'] ?? 'Watch Video',
                'link' => $settings['resource_2_link'] ?? '#',
            ],
            [
                'type' => 'link',
                'title' => $settings['resource_3_title'] ?? 'JavaScript Documentation',
                'description' => $settings['resource_3_description'] ?? 'Official MDN documentation for JavaScript',
                'size' => $settings['resource_3_size'] ?? 'Online Resource',
                'actionText' => $settings['resource_3_action'] ?? 'Visit Site',
                'link' => $settings['resource_3_link'] ?? '#',
            ],
        ];

        return view('public.resources', compact('bootcamp', 'resources'));
    }

    public function assessments($slug)
    {
        $bootcamp = $this->bootcampRepository->findActiveBySlug($slug);

        return view('public.assessments', compact('bootcamp'));
    }

    public function projects($slug)
    {
        $bootcamp = $this->bootcampRepository->findActiveBySlug($slug);

        return view('public.projects', compact('bootcamp'));
    }
}

