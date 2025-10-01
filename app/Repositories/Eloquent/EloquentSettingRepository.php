<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class EloquentSettingRepository implements SettingRepositoryInterface
{
    public function __construct(private readonly Setting $model)
    {
    }

    public function getValues(array $keys): array
    {
        $cacheKey = 'settings:' . md5(json_encode($keys));

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($keys) {
            return $this->model->whereIn('key', $keys)
                ->pluck('value', 'key')
                ->toArray();
        });
    }
}
