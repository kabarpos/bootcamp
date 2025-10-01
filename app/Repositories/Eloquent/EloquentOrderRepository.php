<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function __construct(private readonly Order $model)
    {
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function findByInvoice(string $invoice)
    {
        return $this->model->where('invoice_no', $invoice)->first();
    }

    public function sumPaidTotalForUser(int $userId): float
    {
        return (float) $this->model->paid()
            ->whereHas('enrollment', fn ($query) => $query->where('user_id', $userId))
            ->sum('total');
    }

    public function getPaidForUser(int $userId): Collection
    {
        return $this->model->paid()
            ->whereHas('enrollment', fn ($query) => $query->where('user_id', $userId))
            ->get();
    }
}
