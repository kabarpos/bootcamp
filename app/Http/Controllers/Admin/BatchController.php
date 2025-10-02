<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Bootcamp;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Batch::with(['bootcamp', 'city', 'enrollments']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhereHas('bootcamp', function ($bootcampQuery) use ($search) {
                        $bootcampQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('bootcamp_id')) {
            $query->where('bootcamp_id', $request->get('bootcamp_id'));
        }

        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->get('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->get('end_date'));
        }

        $batches = $query->latest()->paginate(10)->withQueryString();

        $bootcamps = Bootcamp::orderBy('title')->get(['id', 'title']);
        $statuses = [
            'upcoming' => 'Upcoming',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.batches.index', compact('batches', 'bootcamps', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bootcamps = Bootcamp::where('is_active', true)->get();
        $cities = City::all();
        
        return view('admin.batches.create', compact('bootcamps', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bootcamp_id' => 'required|exists:bootcamp,id',
            'code' => 'required|string|max:50|unique:batch,code',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'city_id' => 'nullable|exists:city,id',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string',
            'meeting_link' => 'nullable|url',
            'meeting_platform' => 'nullable|string|max:100',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'capacity' => 'required|integer|min:1|max:1000',
        ]);

        // Validate venue requirements based on bootcamp mode
        $bootcamp = Bootcamp::find($validated['bootcamp_id']);
        
        if ($bootcamp->mode === 'offline' || $bootcamp->mode === 'hybrid') {
            $request->validate([
                'city_id' => 'required|exists:city,id',
                'venue_name' => 'required|string|max:255',
                'venue_address' => 'required|string',
            ]);
        }
        
        if ($bootcamp->mode === 'online' || $bootcamp->mode === 'hybrid') {
            $request->validate([
                'meeting_link' => 'required|url',
                'meeting_platform' => 'required|string|max:100',
            ]);
        }

        Batch::create($validated);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        $batch->load(['bootcamp', 'city', 'enrollments.user']);
        
        return view('admin.batches.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        $bootcamps = Bootcamp::where('is_active', true)->get();
        $cities = City::all();
        
        return view('admin.batches.edit', compact('batch', 'bootcamps', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'bootcamp_id' => 'required|exists:bootcamp,id',
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('batch', 'code')->ignore($batch->id)
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'city_id' => 'nullable|exists:city,id',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string',
            'meeting_link' => 'nullable|url',
            'meeting_platform' => 'nullable|string|max:100',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'capacity' => 'required|integer|min:1|max:1000',
        ]);

        // Validate venue requirements based on bootcamp mode
        $bootcamp = Bootcamp::find($validated['bootcamp_id']);
        
        if ($bootcamp->mode === 'offline' || $bootcamp->mode === 'hybrid') {
            $request->validate([
                'city_id' => 'required|exists:city,id',
                'venue_name' => 'required|string|max:255',
                'venue_address' => 'required|string',
            ]);
        }
        
        if ($bootcamp->mode === 'online' || $bootcamp->mode === 'hybrid') {
            $request->validate([
                'meeting_link' => 'required|url',
                'meeting_platform' => 'required|string|max:100',
            ]);
        }

        // Check if capacity is not less than current enrollments
        if ($validated['capacity'] < $batch->enrolled_count) {
            return redirect()->back()
                ->withErrors(['capacity' => 'Kapasitas tidak boleh kurang dari jumlah peserta yang sudah terdaftar (' . $batch->enrolled_count . ')'])
                ->withInput();
        }

        $batch->update($validated);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        // Check if batch has enrollments
        if ($batch->enrollments()->exists()) {
            return redirect()->route('admin.batches.index')
                ->with('error', 'Tidak dapat menghapus batch yang memiliki peserta terdaftar.');
        }

        $batch->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch berhasil dihapus.');
    }

    /**
     * Update batch status.
     */
    public function updateStatus(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'status' => 'required|in:upcoming,ongoing,completed,cancelled'
        ]);

        $batch->update($validated);

        return redirect()->back()
            ->with('success', 'Status batch berhasil diperbarui.');
    }

    /**
     * Get batches by bootcamp (for AJAX).
     */
    public function getByBootcamp(Request $request)
    {
        $bootcampId = $request->get('bootcamp_id');
        
        $batches = Batch::where('bootcamp_id', $bootcampId)
            ->where('status', 'upcoming')
            ->select('id', 'code', 'start_date')
            ->get();

        return response()->json($batches);
    }
}