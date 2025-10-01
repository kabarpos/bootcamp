<?php

namespace App\Repositories\Contracts;

interface SettingRepositoryInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getValues(array $keys): array;
}
