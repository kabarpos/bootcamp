<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Enrollment::with(['user', 'batch.bootcamp', 'orders']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('batch', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by batch
        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $enrollments = $query->orderBy('created_at', 'desc')->paginate(15);
        $batches = Batch::with('bootcamp')->orderBy('code')->get();
        $users = User::orderBy('email')->get();

        return view('admin.enrollments.index', compact('enrollments', 'batches', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('email')->get();
        $batches = Batch::active()->with('bootcamp')->orderBy('code')->get();
        
        return view('admin.enrollments.create', compact('users', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'batch_id' => 'required|exists:batch,id',
            'referral_id' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        try {
            // Check if user already enrolled in this batch
            $existingEnrollment = Enrollment::where('user_id', $request->user_id)
                                          ->where('batch_id', $request->batch_id)
                                          ->first();

            if ($existingEnrollment) {
                return back()->withErrors(['user_id' => 'User sudah terdaftar di batch ini.'])
                           ->withInput();
            }

            // Check batch capacity
            $batch = Batch::findOrFail($request->batch_id);
            $currentEnrollments = Enrollment::where('batch_id', $request->batch_id)
                                          ->where('status', '!=', 'cancelled')
                                          ->count();

            if ($batch->capacity && $currentEnrollments >= $batch->capacity) {
                return back()->withErrors(['batch_id' => 'Batch sudah penuh.'])
                           ->withInput();
            }

            $enrollment = Enrollment::create($request->all());

            Log::info('Enrollment created', [
                'enrollment_id' => $enrollment->id,
                'user_id' => $enrollment->user_id,
                'batch_id' => $enrollment->batch_id,
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.enrollments.index')
                           ->with('success', 'Enrollment berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Error creating enrollment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat enrollment.'])
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['user', 'batch.bootcamp', 'orders.payments', 'certificate']);
        
        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $users = User::orderBy('email')->get();
        $batches = Batch::with('bootcamp')->orderBy('code')->get();
        
        return view('admin.enrollments.edit', compact('enrollment', 'users', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'batch_id' => 'required|exists:batch,id',
            'referral_id' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        try {
            // Check if user already enrolled in this batch (except current enrollment)
            $existingEnrollment = Enrollment::where('user_id', $request->user_id)
                                          ->where('batch_id', $request->batch_id)
                                          ->where('id', '!=', $enrollment->id)
                                          ->first();

            if ($existingEnrollment) {
                return back()->withErrors(['user_id' => 'User sudah terdaftar di batch ini.'])
                           ->withInput();
            }

            // Check batch capacity if changing batch
            if ($enrollment->batch_id != $request->batch_id) {
                $batch = Batch::findOrFail($request->batch_id);
                $currentEnrollments = Enrollment::where('batch_id', $request->batch_id)
                                              ->where('status', '!=', 'cancelled')
                                              ->count();

                if ($batch->capacity && $currentEnrollments >= $batch->capacity) {
                    return back()->withErrors(['batch_id' => 'Batch sudah penuh.'])
                               ->withInput();
                }
            }

            $enrollment->update([
                'user_id' => $request->user_id,
                'batch_id' => $request->batch_id,
                'referral_id' => $request->referral_id,
                'status' => $request->status,
            ]);

            Log::info('Enrollment updated', [
                'enrollment_id' => $enrollment->id,
                'changes' => $enrollment->getChanges(),
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.enrollments.index')
                           ->with('success', 'Enrollment berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating enrollment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui enrollment.'])
                         ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        try {
            // Check if enrollment has orders
            if ($enrollment->orders()->exists()) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus enrollment yang memiliki order.']);
            }

            // Check if enrollment has certificate
            if ($enrollment->certificate) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus enrollment yang memiliki sertifikat.']);
            }

            $enrollmentData = $enrollment->toArray();
            $enrollment->delete();

            Log::info('Enrollment deleted', [
                'enrollment_data' => $enrollmentData,
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.enrollments.index')
                           ->with('success', 'Enrollment berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting enrollment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus enrollment.']);
        }
    }

    /**
     * Update enrollment status
     */
    public function updateStatus(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        try {
            $oldStatus = $enrollment->status;
            $enrollment->update(['status' => $request->status]);

            Log::info('Enrollment status updated', [
                'enrollment_id' => $enrollment->id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status enrollment berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating enrollment status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status.'
            ], 500);
        }
    }

    /**
     * Bulk update enrollment status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'enrollment_ids' => 'required|array',
            'enrollment_ids.*' => 'exists:enrollment,id',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        try {
            $updated = Enrollment::whereIn('id', $request->enrollment_ids)
                                ->update(['status' => $request->status]);

            Log::info('Bulk enrollment status update', [
                'enrollment_ids' => $request->enrollment_ids,
                'status' => $request->status,
                'updated_count' => $updated,
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => "{$updated} enrollment berhasil diperbarui."
            ]);
        } catch (\Exception $e) {
            Log::error('Error bulk updating enrollment status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status.'
            ], 500);
        }
    }

    /**
     * Get enrollments by batch (AJAX)
     */
    public function getByBatch(Request $request)
    {
        $batchId = $request->batch_id;
        
        $enrollments = Enrollment::with(['user'])
                                ->where('batch_id', $batchId)
                                ->get()
                                ->map(function ($enrollment) {
                                    return [
                                        'id' => $enrollment->id,
                                        'user_name' => $enrollment->user->name,
                                        'user_email' => $enrollment->user->email,
                                        'status' => $enrollment->status,
                                        'created_at' => $enrollment->created_at->format('d/m/Y')
                                    ];
                                });

        return response()->json($enrollments);
    }

    /**
     * Export enrollments to CSV
     */
    public function export(Request $request)
    {
        $query = Enrollment::with(['user', 'batch.bootcamp']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $enrollments = $query->orderBy('created_at', 'desc')->get();

        $filename = 'enrollments_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($enrollments) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'User Name',
                'User Email',
                'Bootcamp',
                'Batch',
                'Status',
                'Referral',
                'Created At',
                'Updated At'
            ]);

            foreach ($enrollments as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->user->name,
                    $enrollment->user->email,
                    $enrollment->batch->bootcamp->title ?? '',
                    $enrollment->batch->code,
                    $enrollment->status,
                    optional($enrollment->referral)->name ?? '',
                    $enrollment->created_at->format('Y-m-d H:i:s'),
                    $enrollment->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get enrollment statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Enrollment::count(),
            'pending' => Enrollment::where('status', 'pending')->count(),
            'confirmed' => Enrollment::where('status', 'confirmed')->count(),
            'cancelled' => Enrollment::where('status', 'cancelled')->count(),
            'completed' => Enrollment::where('status', 'completed')->count(),
            'this_month' => Enrollment::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count(),
            'last_month' => Enrollment::whereMonth('created_at', now()->subMonth()->month)
                                    ->whereYear('created_at', now()->subMonth()->year)
                                    ->count()
        ];

        // Calculate growth percentage
        $stats['growth_percentage'] = $stats['last_month'] > 0 
            ? round((($stats['this_month'] - $stats['last_month']) / $stats['last_month']) * 100, 2)
            : 0;

        return response()->json($stats);
    }
}














