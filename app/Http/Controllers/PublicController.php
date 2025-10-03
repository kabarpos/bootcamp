<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
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
        return view('public.dashboard', $this->dashboardData());
    }

    public function userDashboard()
    {
        return view('dashboard', $this->dashboardData());
    }

    private function dashboardData(): array
    {
        $userId = Auth::id();

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
            'enrollments' => $this->enrollmentRepository->countForUser($userId),
            'certificates' => $this->enrollmentRepository->countCertificatesForUser($userId),
            'total_spent' => $this->orderRepository->sumPaidTotalForUser($userId),
        ];

        $recentEnrollments = $this->enrollmentRepository->getRecentForUser($userId, 6);

        $purchases = $this->preparePurchases($userId);

        return [
            'blogPosts' => $blogPosts,
            'upcomingEvents' => $upcomingEvents,
            'stats' => $stats,
            'recentEnrollments' => $recentEnrollments,
            'purchases' => $purchases,
        ];
    }

    private function preparePurchases(int $userId): Collection
    {
        return $this->enrollmentRepository->getDetailedForUser($userId)
            ->map(function ($enrollment) {
                $batch = $enrollment->batch;
                $bootcamp = $batch?->bootcamp;
                $latestOrder = $enrollment->orders->first();
                $paymentStatusValue = $latestOrder?->status ?? 'pending';

                $paymentStatus = $this->paymentStatusMeta($paymentStatusValue);
                $enrollmentStatus = $this->enrollmentStatusMeta($enrollment->status);

                return [
                    'id' => $enrollment->id,
                    'bootcamp_title' => $bootcamp?->title ?? 'Bootcamp',
                    'bootcamp_slug' => $bootcamp?->slug,
                    'bootcamp_mode' => $bootcamp?->mode,
                    'bootcamp_level' => $bootcamp?->level,
                    'batch_code' => $batch?->code,
                    'date_range' => $this->formatDateRange($batch),
                    'time_range' => $this->formatTimeRange($batch),
                    'payment_status' => $paymentStatus,
                    'enrollment_status' => $enrollmentStatus,
                    'invoice_no' => $latestOrder?->invoice_no,
                    'order_total' => $latestOrder?->total,
                    'expired_at' => optional($latestOrder?->expired_at)->format('d M Y H:i'),
                    'detail_url' => route('student.enrollments.show', $enrollment->id),
                    'checkout_url' => ($paymentStatusValue === 'pending' && $latestOrder) ? route('payment.checkout', $latestOrder->id) : null,
                ];
            })
            ->sortBy(function (array $purchase) {
                return $purchase['payment_status']['value'] === 'pending' ? 0 : 1;
            })
            ->values();
    }


    public function enrollmentDetail(Enrollment $enrollment)
    {
        if ($enrollment->user_id !== Auth::id()) {
            abort(403);
        }

        $enrollment->load([
            'batch.bootcamp',
            'batch.city',
            'orders.payments',
        ]);

        $batch = $enrollment->batch;
        $bootcamp = $batch?->bootcamp;
        $latestOrder = $enrollment->orders->sortByDesc('created_at')->first();
        $latestPayment = $latestOrder?->payments->sortByDesc('created_at')->first();

        return view('public.student.enrollment', [
            'enrollment' => $enrollment,
            'bootcamp' => $bootcamp,
            'batch' => $batch,
            'latestOrder' => $latestOrder,
            'latestPayment' => $latestPayment,
            'paymentMeta' => $this->paymentStatusMeta($latestOrder?->status ?? 'pending'),
            'enrollmentMeta' => $this->enrollmentStatusMeta($enrollment->status),
            'schedule' => [
                'date_range' => $this->formatDateRange($batch),
                'time_range' => $this->formatTimeRange($batch),
                'start_date' => optional($batch?->start_date)->format('d M Y'),
                'end_date' => optional($batch?->end_date)->format('d M Y'),
            ],
            'location' => [
                'mode_label' => $this->bootcampModeLabel($bootcamp?->mode),
                'city' => optional($batch?->city)->name,
                'venue_name' => $batch?->venue_name,
                'venue_address' => $batch?->venue_address,
                'meeting_platform' => $batch?->meeting_platform,
                'meeting_link' => $batch?->meeting_link,
                'map_link' => $this->buildMapLink($batch),
            ],
            'resourcesUrl' => $bootcamp?->slug ? route('public.resources', $bootcamp->slug) : null,
            'checkoutUrl' => ($latestOrder && $latestOrder->status === 'pending') ? route('payment.checkout', $latestOrder->id) : null,
        ]);
    }

    private function paymentStatusMeta(?string $status): array
    {
        $normalized = strtolower($status ?? 'pending');

        return match ($normalized) {
            'paid', 'settlement' => [
                'value' => 'paid',
                'label' => 'Payment Complete',
                'badge' => 'bg-green-100 text-green-800',
            ],
            'expired' => [
                'value' => 'expired',
                'label' => 'Payment Expired',
                'badge' => 'bg-orange-100 text-orange-800',
            ],
            'failed', 'cancel', 'deny' => [
                'value' => 'failed',
                'label' => 'Payment Failed',
                'badge' => 'bg-red-100 text-red-800',
            ],
            'refunded', 'partial_refund' => [
                'value' => 'refunded',
                'label' => 'Payment Refunded',
                'badge' => 'bg-purple-100 text-purple-800',
            ],
            default => [
                'value' => 'pending',
                'label' => 'Pending Payment',
                'badge' => 'bg-yellow-100 text-yellow-800',
            ],
        };
    }

    private function enrollmentStatusMeta(?string $status): array
    {
        $normalized = strtolower($status ?? 'pending');

        return match ($normalized) {
            'confirmed' => [
                'value' => 'confirmed',
                'label' => 'Enrollment Confirmed',
                'badge' => 'bg-blue-100 text-blue-800',
            ],
            'completed' => [
                'value' => 'completed',
                'label' => 'Program Completed',
                'badge' => 'bg-green-100 text-green-800',
            ],
            'cancelled' => [
                'value' => 'cancelled',
                'label' => 'Enrollment Cancelled',
                'badge' => 'bg-red-100 text-red-800',
            ],
            default => [
                'value' => 'pending',
                'label' => 'Awaiting Confirmation',
                'badge' => 'bg-yellow-100 text-yellow-800',
            ],
        };
    }

    private function formatDateRange($batch): ?string
    {
        if (! $batch?->start_date) {
            return null;
        }

        $start = optional($batch->start_date)->format('d M Y');
        $end = optional($batch->end_date)->format('d M Y');

        if ($start && $end && $start !== $end) {
            return $start . ' - ' . $end;
        }

        return $start ?? $end;
    }

    private function formatTimeRange($batch): ?string
    {
        if (! $batch) {
            return null;
        }

        $start = optional($batch->start_time)->format('H:i');
        $end = optional($batch->end_time)->format('H:i');

        if ($start && $end) {
            return $start . ' - ' . $end;
        }

        return $start ?? $end;
    }

    private function bootcampModeLabel(?string $mode): string
    {
        return match ($mode) {
            'online' => 'Online',
            'offline' => 'Offline',
            'hybrid' => 'Hybrid',
            default => 'Bootcamp',
        };
    }

    private function buildMapLink($batch): ?string
    {
        if (! $batch) {
            return null;
        }

        $parts = array_filter([
            $batch->venue_name,
            $batch->venue_address,
            optional($batch->city)->name,
        ]);

        if (empty($parts)) {
            return null;
        }

        return 'https://www.google.com/maps/search/?api=1&query=' . urlencode(implode(', ', $parts));
    }

    public function resources($slug)
    {
        $bootcamp = $this->bootcampRepository->findActiveBySlug($slug);

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $hasAccess = Enrollment::where('user_id', Auth::id())
            ->whereHas('batch', fn ($query) => $query->where('bootcamp_id', $bootcamp->id))
            ->exists();

        if (! $hasAccess) {
            return redirect()->route('public.bootcamp', $bootcamp->slug)
                ->with('error', 'Anda harus terdaftar pada bootcamp ini untuk mengakses materi.');
        }

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


