<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhatsappTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'content',
        'placeholders',
        'is_active',
    ];

    protected $casts = [
        'placeholders' => 'array',
        'is_active' => 'boolean',
    ];

    public function requiredPlaceholders(): array
    {
        if ($this->placeholders !== null) {
            return $this->placeholders;
        }

        preg_match_all('/{{\\s*(.*?)\\s*}}/', $this->content, $matches);

        return array_values(array_unique($matches[1] ?? []));
    }
}
