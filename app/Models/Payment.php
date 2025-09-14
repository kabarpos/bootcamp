<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    
    protected $fillable = [
        'order_id',
        'method',
        'provider',
        'transaction_id',
        'va_number',
        'ewallet_ref',
        'status',
        'paid_at',
        'receipt_url',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}