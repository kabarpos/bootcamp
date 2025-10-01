<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BootcampRepositoryInterface
{
    public function getActiveWithRelations(array $relations = [], ?int $limit = null): Collection;

    public function paginateActive(int $perPage = 12, array $relations = []): LengthAwarePaginator;

    public function findActiveBySlug(string $slug, array $relations = []);
}
