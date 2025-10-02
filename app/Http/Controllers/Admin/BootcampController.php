<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Category;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bootcamp::with(['categories', 'mentors', 'batches']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('mode')) {
            $query->where('mode', $request->get('mode'));
        }

        if ($request->filled('level')) {
            $query->where('level', $request->get('level'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->get('status') === 'active');
        }

        $bootcamps = $query->latest()->paginate(10)->withQueryString();

        $modes = [
            'online' => 'Online',
            'offline' => 'Offline',
            'hybrid' => 'Hybrid',
        ];

        $levels = [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
        ];

        $statuses = [
            'active' => 'Aktif',
            'inactive' => 'Nonaktif',
        ];

        return view('admin.bootcamps.index', compact('bootcamps', 'modes', 'levels', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $mentors = Mentor::all();
        
        return view('admin.bootcamps.create', compact('categories', 'mentors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'mode' => 'required|in:online,offline,hybrid',
            'level' => 'required|in:beginner,intermediate,advanced',
            'base_price' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'short_desc' => 'required|string|max:500',
            'syllabus_summary' => 'required|string',
            'is_active' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:category,id',
            'mentors' => 'array',
            'mentors.*' => 'exists:mentor,id',
        ]);

        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Bootcamp::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $bootcamp = Bootcamp::create($validated);

        // Attach categories and mentors
        if (isset($validated['categories'])) {
            $bootcamp->categories()->attach($validated['categories']);
        }
        
        if (isset($validated['mentors'])) {
            $bootcamp->mentors()->attach($validated['mentors']);
        }

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'Bootcamp berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bootcamp $bootcamp)
    {
        $bootcamp->load(['categories', 'mentors', 'batches.enrollments']);
        
        return view('admin.bootcamps.show', compact('bootcamp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bootcamp $bootcamp)
    {
        $categories = Category::all();
        $mentors = Mentor::all();
        $bootcamp->load(['categories', 'mentors']);
        
        return view('admin.bootcamps.edit', compact('bootcamp', 'categories', 'mentors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bootcamp $bootcamp)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'mode' => 'required|in:online,offline,hybrid',
            'level' => 'required|in:beginner,intermediate,advanced',
            'base_price' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'short_desc' => 'required|string|max:500',
            'syllabus_summary' => 'required|string',
            'is_active' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:category,id',
            'mentors' => 'array',
            'mentors.*' => 'exists:mentor,id',
        ]);

        // Update slug if title changed
        if ($validated['title'] !== $bootcamp->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure slug is unique (excluding current bootcamp)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Bootcamp::where('slug', $validated['slug'])->where('id', '!=', $bootcamp->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $bootcamp->update($validated);

        // Sync categories and mentors
        $bootcamp->categories()->sync($validated['categories'] ?? []);
        $bootcamp->mentors()->sync($validated['mentors'] ?? []);

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'Bootcamp berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bootcamp $bootcamp)
    {
        // Check if bootcamp has active batches
        if ($bootcamp->activeBatches()->exists()) {
            return redirect()->route('admin.bootcamps.index')
                ->with('error', 'Tidak dapat menghapus bootcamp yang memiliki batch aktif.');
        }

        // Detach relationships
        $bootcamp->categories()->detach();
        $bootcamp->mentors()->detach();
        
        $bootcamp->delete();

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'Bootcamp berhasil dihapus.');
    }

    /**
     * Toggle active status of bootcamp.
     */
    public function toggleStatus(Bootcamp $bootcamp)
    {
        $bootcamp->update([
            'is_active' => !$bootcamp->is_active
        ]);

        $status = $bootcamp->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Bootcamp berhasil {$status}.");
    }
}