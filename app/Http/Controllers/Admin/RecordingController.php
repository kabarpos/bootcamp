<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecordingRequest;
use App\Http\Requests\Admin\UpdateRecordingRequest;
use App\Models\Bootcamp;
use App\Models\BootcampRecording;
use App\Models\Batch;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'bootcamp_id', 'batch_id', 'status']);

        $recordings = BootcampRecording::query()
            ->with(['batch.bootcamp'])
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($filters['bootcamp_id'] ?? null, function ($query, $bootcampId) {
                $query->whereHas('batch', fn ($q) => $q->where('bootcamp_id', $bootcampId));
            })
            ->when($filters['batch_id'] ?? null, function ($query, $batchId) {
                $query->where('batch_id', $batchId);
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('is_published', (bool) $filters['status']);
            })
            ->orderBy('position')
            ->orderByDesc('recorded_at')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $bootcamps = Bootcamp::query()
            ->with('batches')
            ->orderBy('title')
            ->get();

        $batches = Batch::query()
            ->with('bootcamp')
            ->when($filters['bootcamp_id'] ?? null, fn ($query, $bootcampId) => $query->where('bootcamp_id', $bootcampId))
            ->orderBy('code')
            ->get();

        return view('admin.recordings.index', [
            'recordings' => $recordings,
            'bootcamps' => $bootcamps,
            'batches' => $batches,
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        $bootcamps = Bootcamp::with('batches')->orderBy('title')->get();

        return view('admin.recordings.create', [
            'bootcamps' => $bootcamps,
        ]);
    }

    public function store(StoreRecordingRequest $request)
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');
        $data['position'] = isset($data['position']) ? (int) $data['position'] : 0;

        BootcampRecording::create($data);

        return redirect()
            ->route('admin.recordings.index')
            ->with('success', 'Rekaman bootcamp berhasil ditambahkan.');
    }

    public function edit(BootcampRecording $recording)
    {
        $bootcamps = Bootcamp::with('batches')->orderBy('title')->get();

        return view('admin.recordings.edit', [
            'recording' => $recording,
            'bootcamps' => $bootcamps,
        ]);
    }

    public function update(UpdateRecordingRequest $request, BootcampRecording $recording)
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');
        $data['position'] = isset($data['position']) ? (int) $data['position'] : 0;

        $recording->update($data);

        return redirect()
            ->route('admin.recordings.index')
            ->with('success', 'Rekaman bootcamp diperbarui.');
    }

    public function destroy(BootcampRecording $recording)
    {
        $recording->delete();

        return redirect()
            ->route('admin.recordings.index')
            ->with('success', 'Rekaman bootcamp dihapus.');
    }
}
