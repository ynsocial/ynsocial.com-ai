<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'read',
        'replied',
    ];

    protected $casts = [
        'read' => 'boolean',
        'replied' => 'boolean',
    ];

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    /**
     * Scope a query to only include unreplied messages.
     */
    public function scopeUnreplied($query)
    {
        return $query->where('replied', false);
    }
} 