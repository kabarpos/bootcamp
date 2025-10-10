<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BootcampRecording extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'title',
        'youtube_url',
        'description',
        'recorded_at',
        'position',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'recorded_at' => 'datetime',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getYoutubeIdAttribute(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        $url = $this->youtube_url;

        // Handle youtu.be short links
        if (Str::startsWith($url, 'https://youtu.be/')) {
            return Str::of($url)->after('https://youtu.be/')->before('?')->before('&')->value();
        }

        // Parse standard youtube URL
        $parsed = parse_url($url);
        if ($parsed === false) {
            return null;
        }

        if (($parsed['host'] ?? '') === 'www.youtube.com' || ($parsed['host'] ?? '') === 'youtube.com') {
            if (($parsed['path'] ?? '') === '/watch') {
                parse_str($parsed['query'] ?? '', $query);

                return $query['v'] ?? null;
            }

            if (Str::startsWith($parsed['path'] ?? '', '/embed/')) {
                return Str::of($parsed['path'])->after('/embed/')->before('?')->before('&')->value();
            }
        }

        return null;
    }

    public function getEmbedUrlAttribute(): string
    {
        return $this->youtube_id
            ? "https://www.youtube.com/embed/{$this->youtube_id}"
            : $this->youtube_url;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->youtube_id
            ? "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg"
            : null;
    }
}
