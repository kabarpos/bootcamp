<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BatchRepositoryInterface
{
    public function find(int $id, array $relations = []);

    public function getUpcomingByBootcamp(int $bootcampId, array $relations = []): Collection;

    public function countEnrollments(int $batchId): int;
}
