<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bootcamp extends Model
{
    use HasFactory;

    protected $table = 'bootcamp';

    protected $fillable = [
        'title',
        'slug',
        'mode',
        'level',
        'base_price',
        'duration_hours',
        'short_desc',
        'syllabus_summary',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the batches for the bootcamp.
     */
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    /**
     * Get the categories for the bootcamp.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'bootcamp_category');
    }

    /**
     * Get the mentors for the bootcamp.
     */
    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'bootcamp_mentor');
    }

    /**
     * Get active batches.
     */
    public function activeBatches()
    {
        return $this->batches()->whereIn('status', ['upcoming', 'ongoing']);
    }
}
