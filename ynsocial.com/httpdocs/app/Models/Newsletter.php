<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'active',
        'unsubscribed_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true)
            ->whereNull('unsubscribed_at');
    }
}
