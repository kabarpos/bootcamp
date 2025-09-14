<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Enrollment;
use App\Models\Voucher;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['enrollment.user', 'enrollment.batch.bootcamp', 'voucher', 'payments']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('invoice_no', 'like', "%{$search}%")
                  ->orWhereHas('enrollment.user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        // Amount range filter
        if ($request->filled('amount_min')) {
            $query->where('total', '>=', $request->get('amount_min'));
        }
        if ($request->filled('amount_max')) {
            $query->where('total', '<=', $request->get('amount_max'));
        }

        $orders = $query->latest()->paginate(15);
        
        // Statistics for dashboard
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'paid_orders' => Order::where('status', 'paid')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('status', 'paid')->sum('total'),
            'monthly_revenue' => Order::where('status', 'paid')
                                    ->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('total'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::with(['user', 'batch.bootcamp'])
                                ->whereDoesntHave('orders')
                                ->get();
        $vouchers = Voucher::where('is_active', true)
                          ->where('valid_to', '>=', now())
                          ->get();
        
        return view('admin.orders.create', compact('enrollments', 'vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id|unique:orders,enrollment_id',
            'amount' => 'required|numeric|min:0',
            'voucher_id' => 'nullable|exists:vouchers,id',
            'status' => 'required|in:pending,paid,cancelled,expired',
            'expired_at' => 'nullable|date|after:now',
        ]);

        // Calculate discount and total
        $amount = $validated['amount'];
        $discountAmount = 0;
        
        if (isset($validated['voucher_id'])) {
            $voucher = Voucher::find($validated['voucher_id']);
            if ($voucher && $voucher->is_active && $voucher->valid_to >= now()) {
                if ($voucher->type === 'percentage') {
                    $discountAmount = ($amount * $voucher->value) / 100;
                } else {
                    $discountAmount = $voucher->value;
                }
                $discountAmount = min($discountAmount, $amount); // Discount tidak boleh lebih dari amount
            }
        }

        $total = $amount - $discountAmount;

        // Generate invoice number
        $invoiceNo = 'INV-' . date('Ymd') . '-' . str_pad(Order::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'enrollment_id' => $validated['enrollment_id'],
            'invoice_no' => $invoiceNo,
            'amount' => $amount,
            'discount_amount' => $discountAmount,
            'total' => $total,
            'voucher_id' => $validated['voucher_id'] ?? null,
            'status' => $validated['status'],
            'expired_at' => $validated['expired_at'] ?? now()->addDays(7), // Default 7 days
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['enrollment.user', 'enrollment.batch.bootcamp', 'voucher', 'payments']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $enrollments = Enrollment::with(['user', 'batch.bootcamp'])->get();
        $vouchers = Voucher::where('is_active', true)->get();
        $order->load(['enrollment', 'voucher']);
        
        return view('admin.orders.edit', compact('order', 'enrollments', 'vouchers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'enrollment_id' => [
                'required',
                'exists:enrollments,id',
                Rule::unique('orders', 'enrollment_id')->ignore($order->id)
            ],
            'amount' => 'required|numeric|min:0',
            'voucher_id' => 'nullable|exists:vouchers,id',
            'status' => 'required|in:pending,paid,cancelled,expired',
            'expired_at' => 'nullable|date',
        ]);

        // Recalculate discount and total
        $amount = $validated['amount'];
        $discountAmount = 0;
        
        if (isset($validated['voucher_id'])) {
            $voucher = Voucher::find($validated['voucher_id']);
            if ($voucher && $voucher->is_active) {
                if ($voucher->type === 'percentage') {
                    $discountAmount = ($amount * $voucher->value) / 100;
                } else {
                    $discountAmount = $voucher->value;
                }
                $discountAmount = min($discountAmount, $amount);
            }
        }

        $total = $amount - $discountAmount;

        $order->update([
            'enrollment_id' => $validated['enrollment_id'],
            'amount' => $amount,
            'discount_amount' => $discountAmount,
            'total' => $total,
            'voucher_id' => $validated['voucher_id'] ?? null,
            'status' => $validated['status'],
            'expired_at' => $validated['expired_at'],
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Check if order has payments
        if ($order->payments()->exists()) {
            return redirect()->route('admin.orders.index')
                ->with('error', 'Tidak dapat menghapus order yang sudah memiliki payment.');
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dihapus.');
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,cancelled,expired',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->status;
        $order->update(['status' => $validated['status']]);

        // Log status change if needed
        // You can create a OrderStatusLog model for this

        return redirect()->back()
            ->with('success', "Status order berhasil diubah dari {$oldStatus} ke {$validated['status']}.");
    }

    /**
     * Mark order as paid.
     */
    public function markAsPaid(Order $order)
    {
        if ($order->status === 'paid') {
            return redirect()->back()
                ->with('info', 'Order sudah dalam status paid.');
        }

        $order->update(['status' => 'paid']);

        return redirect()->back()
            ->with('success', 'Order berhasil ditandai sebagai paid.');
    }

    /**
     * Cancel order.
     */
    public function cancel(Order $order)
    {
        if ($order->status === 'paid') {
            return redirect()->back()
                ->with('error', 'Tidak dapat membatalkan order yang sudah paid.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', 'Order berhasil dibatalkan.');
    }

    /**
     * Extend order expiration.
     */
    public function extendExpiration(Request $request, Order $order)
    {
        $validated = $request->validate([
            'expired_at' => 'required|date|after:now',
        ]);

        $order->update(['expired_at' => $validated['expired_at']]);

        return redirect()->back()
            ->with('success', 'Tanggal expired order berhasil diperpanjang.');
    }

    /**
     * Get order statistics for dashboard.
     */
    public function getStatistics()
    {
        $stats = [
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'today_revenue' => Order::where('status', 'paid')
                                   ->whereDate('created_at', today())
                                   ->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'expired_orders' => Order::where('status', 'pending')
                                    ->where('expired_at', '<', now())
                                    ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Export orders to CSV.
     */
    public function export(Request $request)
    {
        $query = Order::with(['enrollment.user', 'enrollment.batch.bootcamp', 'voucher']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        $orders = $query->get();

        $filename = 'orders_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Invoice No', 'User', 'Bootcamp', 'Amount', 'Discount', 'Total', 'Status', 'Created At']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->invoice_no,
                    $order->enrollment->user->name ?? '',
                    $order->enrollment->batch->bootcamp->title ?? '',
                    $order->amount,
                    $order->discount_amount,
                    $order->total,
                    $order->status,
                    $order->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}