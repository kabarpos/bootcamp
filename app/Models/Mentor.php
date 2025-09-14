<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mentor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'headline',
        'bio',
        'photo_url',
        'linkedin_url',
        'website_url',
    ];
}