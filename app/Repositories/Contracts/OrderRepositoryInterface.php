<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function create(array $attributes);

    public function findByInvoice(string $invoice);

    public function sumPaidTotalForUser(int $userId): float;

    public function getPaidForUser(int $userId): Collection;
}
