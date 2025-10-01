<?php

namespace App\Repositories\Eloquent;

use App\Models\Batch;
use App\Repositories\Contracts\BatchRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentBatchRepository implements BatchRepositoryInterface
{
    public function __construct(private readonly Batch $model)
    {
    }

    public function find(int $id, array $relations = [])
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function getUpcomingByBootcamp(int $bootcampId, array $relations = []): Collection
    {
        return $this->model->with($relations)
            ->where('bootcamp_id', $bootcampId)
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('start_date')
            ->get();
    }

    public function countEnrollments(int $batchId): int
    {
        return $this->model->findOrFail($batchId)
            ->enrollments()
            ->count();
    }
}
