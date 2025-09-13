<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Certificate::with(['enrollment.user', 'enrollment.batch.bootcamp']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('certificate_no', 'like', "%{$search}%")
                  ->orWhereHas('enrollment.user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('enrollment.batch', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Filter by batch
        if ($request->filled('batch_id')) {
            $query->whereHas('enrollment', function ($q) use ($request) {
                $q->where('batch_id', $request->batch_id);
            });
        }

        // Filter by issued status
        if ($request->filled('issued_status')) {
            if ($request->issued_status === 'issued') {
                $query->whereNotNull('issued_at');
            } elseif ($request->issued_status === 'not_issued') {
                $query->whereNull('issued_at');
            }
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $certificates = $query->orderBy('created_at', 'desc')->paginate(15);
        $batches = Batch::orderBy('name')->get();

        return view('admin.certificates.index', compact('certificates', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get completed enrollments without certificates
        $enrollments = Enrollment::with(['user', 'batch.bootcamp'])
                                ->where('status', 'completed')
                                ->whereDoesntHave('certificate')
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('admin.certificates.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollment,id',
            'issue_immediately' => 'boolean'
        ]);

        try {
            // Check if enrollment already has certificate
            $existingCertificate = Certificate::where('enrollment_id', $request->enrollment_id)->first();
            if ($existingCertificate) {
                return back()->withErrors(['enrollment_id' => 'Enrollment sudah memiliki sertifikat.'])
                           ->withInput();
            }

            // Check if enrollment is completed
            $enrollment = Enrollment::findOrFail($request->enrollment_id);
            if ($enrollment->status !== 'completed') {
                return back()->withErrors(['enrollment_id' => 'Enrollment belum selesai.'])
                           ->withInput();
            }

            $certificateData = [
                'enrollment_id' => $request->enrollment_id,
                'certificate_no' => Certificate::generateCertificateNumber(),
                'file_url' => '', // Will be generated later
            ];

            if ($request->issue_immediately) {
                $certificateData['issued_at'] = now();
            }

            $certificate = Certificate::create($certificateData);

            // Generate PDF if issued immediately
            if ($request->issue_immediately) {
                $this->generateCertificatePDF($certificate);
            }

            Log::info('Certificate created', [
                'certificate_id' => $certificate->id,
                'enrollment_id' => $certificate->enrollment_id,
                'certificate_no' => $certificate->certificate_no,
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.certificates.index')
                           ->with('success', 'Sertifikat berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Error creating certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat sertifikat.'])
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $certificate->load(['enrollment.user', 'enrollment.batch.bootcamp']);
        
        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        $enrollments = Enrollment::with(['user', 'batch.bootcamp'])
                                ->where('status', 'completed')
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('admin.certificates.edit', compact('certificate', 'enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollment,id',
        ]);

        try {
            // Check if enrollment already has certificate (except current)
            $existingCertificate = Certificate::where('enrollment_id', $request->enrollment_id)
                                            ->where('id', '!=', $certificate->id)
                                            ->first();
            if ($existingCertificate) {
                return back()->withErrors(['enrollment_id' => 'Enrollment sudah memiliki sertifikat.'])
                           ->withInput();
            }

            // Check if enrollment is completed
            $enrollment = Enrollment::findOrFail($request->enrollment_id);
            if ($enrollment->status !== 'completed') {
                return back()->withErrors(['enrollment_id' => 'Enrollment belum selesai.'])
                           ->withInput();
            }

            $certificate->update([
                'enrollment_id' => $request->enrollment_id
            ]);

            // Regenerate PDF if certificate is already issued
            if ($certificate->isIssued()) {
                $this->generateCertificatePDF($certificate);
            }

            Log::info('Certificate updated', [
                'certificate_id' => $certificate->id,
                'changes' => $certificate->getChanges(),
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.certificates.index')
                           ->with('success', 'Sertifikat berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui sertifikat.'])
                         ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        try {
            // Delete file if exists
            if ($certificate->file_url && Storage::exists($certificate->file_url)) {
                Storage::delete($certificate->file_url);
            }

            $certificateData = $certificate->toArray();
            $certificate->delete();

            Log::info('Certificate deleted', [
                'certificate_data' => $certificateData,
                'admin_id' => auth()->id()
            ]);

            return redirect()->route('admin.certificates.index')
                           ->with('success', 'Sertifikat berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus sertifikat.']);
        }
    }

    /**
     * Issue certificate
     */
    public function issue(Certificate $certificate)
    {
        try {
            if ($certificate->isIssued()) {
                return back()->withErrors(['error' => 'Sertifikat sudah diterbitkan.']);
            }

            $certificate->update(['issued_at' => now()]);
            $this->generateCertificatePDF($certificate);

            Log::info('Certificate issued', [
                'certificate_id' => $certificate->id,
                'issued_at' => $certificate->issued_at,
                'admin_id' => auth()->id()
            ]);

            return back()->with('success', 'Sertifikat berhasil diterbitkan.');
        } catch (\Exception $e) {
            Log::error('Error issuing certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menerbitkan sertifikat.']);
        }
    }

    /**
     * Revoke certificate
     */
    public function revoke(Certificate $certificate)
    {
        try {
            if (!$certificate->isIssued()) {
                return back()->withErrors(['error' => 'Sertifikat belum diterbitkan.']);
            }

            $certificate->update(['issued_at' => null]);

            // Delete file if exists
            if ($certificate->file_url && Storage::exists($certificate->file_url)) {
                Storage::delete($certificate->file_url);
                $certificate->update(['file_url' => '']);
            }

            Log::info('Certificate revoked', [
                'certificate_id' => $certificate->id,
                'admin_id' => auth()->id()
            ]);

            return back()->with('success', 'Sertifikat berhasil dicabut.');
        } catch (\Exception $e) {
            Log::error('Error revoking certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mencabut sertifikat.']);
        }
    }

    /**
     * Bulk issue certificates
     */
    public function bulkIssue(Request $request)
    {
        $request->validate([
            'certificate_ids' => 'required|array',
            'certificate_ids.*' => 'exists:certificate,id'
        ]);

        try {
            $certificates = Certificate::whereIn('id', $request->certificate_ids)
                                     ->whereNull('issued_at')
                                     ->get();

            $issuedCount = 0;
            foreach ($certificates as $certificate) {
                $certificate->update(['issued_at' => now()]);
                $this->generateCertificatePDF($certificate);
                $issuedCount++;
            }

            Log::info('Bulk certificate issue', [
                'certificate_ids' => $request->certificate_ids,
                'issued_count' => $issuedCount,
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => "{$issuedCount} sertifikat berhasil diterbitkan."
            ]);
        } catch (\Exception $e) {
            Log::error('Error bulk issuing certificates: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menerbitkan sertifikat.'
            ], 500);
        }
    }

    /**
     * Download certificate PDF
     */
    public function download(Certificate $certificate)
    {
        try {
            if (!$certificate->isIssued()) {
                return back()->withErrors(['error' => 'Sertifikat belum diterbitkan.']);
            }

            if (!$certificate->file_url || !Storage::exists($certificate->file_url)) {
                // Regenerate PDF if not exists
                $this->generateCertificatePDF($certificate);
            }

            $filename = "certificate_{$certificate->certificate_no}.pdf";
            return Storage::download($certificate->file_url, $filename);
        } catch (\Exception $e) {
            Log::error('Error downloading certificate: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengunduh sertifikat.']);
        }
    }

    /**
     * Generate certificate for completed enrollments
     */
    public function generateForCompleted(Request $request)
    {
        try {
            $completedEnrollments = Enrollment::where('status', 'completed')
                                            ->whereDoesntHave('certificate')
                                            ->get();

            $generatedCount = 0;
            foreach ($completedEnrollments as $enrollment) {
                Certificate::create([
                    'enrollment_id' => $enrollment->id,
                    'certificate_no' => Certificate::generateCertificateNumber(),
                    'file_url' => '',
                ]);
                $generatedCount++;
            }

            Log::info('Bulk certificate generation for completed enrollments', [
                'generated_count' => $generatedCount,
                'admin_id' => auth()->id()
            ]);

            return back()->with('success', "{$generatedCount} sertifikat berhasil dibuat untuk enrollment yang selesai.");
        } catch (\Exception $e) {
            Log::error('Error generating certificates for completed enrollments: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat sertifikat.']);
        }
    }

    /**
     * Export certificates to CSV
     */
    public function export(Request $request)
    {
        $query = Certificate::with(['enrollment.user', 'enrollment.batch.bootcamp']);

        // Apply same filters as index
        if ($request->filled('batch_id')) {
            $query->whereHas('enrollment', function ($q) use ($request) {
                $q->where('batch_id', $request->batch_id);
            });
        }
        if ($request->filled('issued_status')) {
            if ($request->issued_status === 'issued') {
                $query->whereNotNull('issued_at');
            } elseif ($request->issued_status === 'not_issued') {
                $query->whereNull('issued_at');
            }
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $certificates = $query->orderBy('created_at', 'desc')->get();

        $filename = 'certificates_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($certificates) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // CSV headers
            fputcsv($file, [
                'Certificate No',
                'User Name',
                'User Email',
                'Bootcamp',
                'Batch',
                'Issued At',
                'Created At',
                'File URL'
            ]);

            foreach ($certificates as $certificate) {
                fputcsv($file, [
                    $certificate->certificate_no,
                    $certificate->enrollment->user->name,
                    $certificate->enrollment->user->email,
                    $certificate->enrollment->batch->bootcamp->name ?? '',
                    $certificate->enrollment->batch->name,
                    $certificate->issued_at ? $certificate->issued_at->format('Y-m-d H:i:s') : '',
                    $certificate->created_at->format('Y-m-d H:i:s'),
                    $certificate->file_url
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get certificate statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Certificate::count(),
            'issued' => Certificate::whereNotNull('issued_at')->count(),
            'not_issued' => Certificate::whereNull('issued_at')->count(),
            'this_month' => Certificate::whereMonth('created_at', now()->month)
                                     ->whereYear('created_at', now()->year)
                                     ->count(),
            'last_month' => Certificate::whereMonth('created_at', now()->subMonth()->month)
                                     ->whereYear('created_at', now()->subMonth()->year)
                                     ->count()
        ];

        // Calculate growth percentage
        $stats['growth_percentage'] = $stats['last_month'] > 0 
            ? round((($stats['this_month'] - $stats['last_month']) / $stats['last_month']) * 100, 2)
            : 0;

        return response()->json($stats);
    }

    /**
     * Generate certificate PDF
     */
    private function generateCertificatePDF(Certificate $certificate)
    {
        $certificate->load(['enrollment.user', 'enrollment.batch.bootcamp']);
        
        $data = [
            'certificate' => $certificate,
            'user' => $certificate->enrollment->user,
            'batch' => $certificate->enrollment->batch,
            'bootcamp' => $certificate->enrollment->batch->bootcamp,
            'issued_date' => $certificate->issued_at ? $certificate->issued_at->format('d F Y') : date('d F Y')
        ];

        $pdf = Pdf::loadView('admin.certificates.template', $data)
                  ->setPaper('a4', 'landscape')
                  ->setOptions([
                      'dpi' => 150,
                      'defaultFont' => 'sans-serif',
                      'isHtml5ParserEnabled' => true,
                      'isRemoteEnabled' => true
                  ]);

        $filename = "certificates/{$certificate->certificate_no}.pdf";
        Storage::put($filename, $pdf->output());
        
        $certificate->update(['file_url' => $filename]);
        
        return $filename;
    }
}