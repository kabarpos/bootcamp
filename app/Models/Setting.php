<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'setting';
    
    protected $fillable = [
        'key',
        'value',
        'group_key',
    ];
    
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $cached = Cache::get(self::cacheKey($key));
        if ($cached !== null) {
            return $cached;
        }

        $setting = self::where('key', $key)->value('value');
        if ($setting === null) {
            return $default;
        }

        Cache::put(self::cacheKey($key), $setting, now()->addMinutes(10));

        return $setting;
    }
    
    /**
     * Set a setting value by key
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget(self::cacheKey($key));
    }

    protected static function cacheKey(string $key): string
    {
        return "settings:{$key}";
    }
}
