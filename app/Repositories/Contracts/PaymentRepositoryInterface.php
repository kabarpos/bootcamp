<?php

namespace App\Repositories\Contracts;

interface PaymentRepositoryInterface
{
    public function updateOrCreateForOrder(int $orderId, array $attributes);
}
