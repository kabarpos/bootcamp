<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentor';

    protected $fillable = [
        'user_id',
        'name',
        'headline',
        'bio',
        'photo_url',
        'linkedin_url',
        'website_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}