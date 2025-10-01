<?php

namespace App\Repositories\Eloquent;

use App\Models\Bootcamp;
use App\Repositories\Contracts\BootcampRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentBootcampRepository implements BootcampRepositoryInterface
{
    public function __construct(private readonly Bootcamp $model)
    {
    }

    public function getActiveWithRelations(array $relations = [], ?int $limit = null): Collection
    {
        $query = $this->model->with($relations)
            ->where('is_active', true)
            ->latest();

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }

    public function paginateActive(int $perPage = 12, array $relations = []): LengthAwarePaginator
    {
        return $this->model->with($relations)
            ->where('is_active', true)
            ->latest()
            ->paginate($perPage);
    }

    public function findActiveBySlug(string $slug, array $relations = [])
    {
        return $this->model->with($relations)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }
}
