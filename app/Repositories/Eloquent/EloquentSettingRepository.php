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
        $values = [];
        $missingKeys = [];

        foreach ($keys as $key) {
            $cacheKey = "settings:{$key}";
            if (Cache::has($cacheKey)) {
                $values[$key] = Cache::get($cacheKey);
                continue;
            }

            $missingKeys[] = $key;
        }

        if ($missingKeys) {
            $fetched = $this->model->whereIn('key', $missingKeys)
                ->pluck('value', 'key');

            foreach ($missingKeys as $key) {
                $value = $fetched[$key] ?? null;
                Cache::put("settings:{$key}", $value, now()->addMinutes(10));
                $values[$key] = $value;
            }
        }

        return $values;
    }
}
