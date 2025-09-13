<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';

    protected $fillable = [
        'bootcamp_id',
        'code',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'city_id',
        'venue_name',
        'venue_address',
        'meeting_link',
        'meeting_platform',
        'status',
        'capacity',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    /**
     * Get the bootcamp that owns the batch.
     */
    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }

    /**
     * Get the city that owns the batch.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the enrollments for the batch.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Scope for active batches.
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['upcoming', 'ongoing']);
    }

    /**
     * Scope for upcoming batches.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    /**
     * Scope for ongoing batches.
     */
    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }

    /**
     * Get enrolled count.
     */
    public function getEnrolledCountAttribute()
    {
        return $this->enrollments()->confirmed()->count();
    }

    /**
     * Get available slots.
     */
    public function getAvailableSlotsAttribute()
    {
        return $this->capacity - $this->enrolled_count;
    }
}
