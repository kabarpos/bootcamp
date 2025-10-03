<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface EnrollmentRepositoryInterface
{
    public function userHasEnrollment(int $userId, int $batchId): bool;

    public function create(array $attributes);

    public function getRecentForUser(int $userId, int $limit = 6): Collection;

    public function countForUser(int $userId): int;

    public function countCertificatesForUser(int $userId): int;

    public function getDetailedForUser(int $userId): Collection;
}
