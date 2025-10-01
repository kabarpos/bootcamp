<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BlogPostRepositoryInterface
{
    public function getPublished(int $limit = 3, array $relations = []): Collection;
}
