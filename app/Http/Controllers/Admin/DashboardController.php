<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bootcamp;
use App\Models\Order;
use App\Models\Enrollment;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_bootcamps' => Bootcamp::where('is_active', true)->count(),
            'active_batches' => Batch::active()->count(),
            'total_orders' => Order::paid()->count(),
            'total_revenue' => Order::paid()->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        // Get recent activities with proper relationships
        $recent_orders = Order::with([
                'enrollment.user:id,name,email',
                'enrollment.batch:id,code,bootcamp_id',
                'enrollment.batch.bootcamp:id,title'
            ])
            ->latest()
            ->take(5)
            ->get();

        $recent_enrollments = Enrollment::with([
                'user:id,name,email',
                'batch:id,code,bootcamp_id,start_date',
                'batch.bootcamp:id,title'
            ])
            ->latest()
            ->take(5)
            ->get();

        // Get monthly revenue data for chart (current year)
        $monthly_revenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->where('status', 'paid')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();

        // Fill missing months with 0
        $revenue_data = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenue_data[] = (float) ($monthly_revenue[$i] ?? 0);
        }

        // Get top bootcamps by enrollment
        $top_bootcamps = Bootcamp::withCount(['batches as total_enrollments' => function($query) {
                $query->join('enrollment', 'batch.id', '=', 'enrollment.batch_id')
                      ->where('enrollment.status', 'confirmed');
            }])
            ->where('is_active', true)
            ->orderBy('total_enrollments', 'desc')
            ->take(5)
            ->get();

        // Get enrollment trends (last 6 months)
        $enrollment_trends = Enrollment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->where('status', 'confirmed')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'stats', 
            'recent_orders', 
            'recent_enrollments', 
            'revenue_data',
            'top_bootcamps',
            'enrollment_trends'
        ));
    }
}