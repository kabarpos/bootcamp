<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificate';

    protected $fillable = [
        'enrollment_id',
        'certificate_no',
        'file_url',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    /**
     * Get the enrollment that owns the certificate.
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Convenience accessor for the related user.
     */
    public function getUserAttribute()
    {
        return $this->enrollment?->user;
    }

    /**
     * Convenience accessor for the related batch.
     */
    public function getBatchAttribute()
    {
        return $this->enrollment?->batch;
    }

    /**
     * Scope for issued certificates.
     */
    public function scopeIssued($query)
    {
        return $query->whereNotNull('issued_at');
    }

    /**
     * Scope for recent certificates.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Generate unique certificate number.
     */
    public static function generateCertificateNumber()
    {
        $prefix = 'CERT';
        $year = date('Y');
        $month = date('m');
        
        // Get the last certificate number for this month
        $lastCert = self::where('certificate_no', 'like', "{$prefix}-{$year}{$month}-%")
                       ->orderBy('certificate_no', 'desc')
                       ->first();
        
        if ($lastCert) {
            $lastNumber = (int) substr($lastCert->certificate_no, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return sprintf('%s-%s%s-%04d', $prefix, $year, $month, $newNumber);
    }

    /**
     * Check if certificate is issued.
     */
    public function isIssued()
    {
        return !is_null($this->issued_at);
    }
}
