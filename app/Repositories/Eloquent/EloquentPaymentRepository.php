<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class EloquentPaymentRepository implements PaymentRepositoryInterface
{
    public function __construct(private readonly Payment $model)
    {
    }

    public function updateOrCreateForOrder(int $orderId, array $attributes)
    {
        return $this->model->updateOrCreate(
            ['order_id' => $orderId],
            $attributes
        );
    }
}
