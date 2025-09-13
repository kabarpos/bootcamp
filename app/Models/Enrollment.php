<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';

    protected $fillable = [
        'user_id',
        'batch_id',
        'referral_id',
        'status',
    ];

    /**
     * Get the user that owns the enrollment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the batch that owns the enrollment.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Get the orders for the enrollment.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the certificate for the enrollment.
     */
    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    /**
     * Scope for confirmed enrollments.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope for recent enrollments.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
