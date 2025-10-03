<?php

namespace App\Repositories\Eloquent;

use App\Models\Enrollment;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentEnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function __construct(private readonly Enrollment $model)
    {
    }

    public function userHasEnrollment(int $userId, int $batchId): bool
    {
        return $this->model->where('user_id', $userId)
            ->where('batch_id', $batchId)
            ->exists();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function getRecentForUser(int $userId, int $limit = 6): Collection
    {
        return $this->model->with(['batch.bootcamp', 'certificate'])
            ->where('user_id', $userId)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function countForUser(int $userId): int
    {
        return $this->model->where('user_id', $userId)->count();
    }
    public function countCertificatesForUser(int $userId): int
    {
        return $this->model->where('user_id', $userId)
            ->whereHas('certificate', fn ($query) => $query->whereNotNull('issued_at'))
            ->count();
    }

    public function getDetailedForUser(int $userId): Collection
    {
        return $this->model->with([
            'batch.bootcamp',
            'batch.city',
            'orders' => function ($query) {
                $query->latest();
            },
            'orders.payments',
        ])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

}




