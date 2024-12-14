<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'email',
        'phone',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'active',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Scope a query to only include active team members.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
} 