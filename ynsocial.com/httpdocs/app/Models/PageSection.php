<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'name',
        'type',
        'content',
        'active',
        'order'
    ];

    protected $casts = [
        'content' => 'array',
        'active' => 'boolean'
    ];

    // Relationships
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_section_pivot')
                    ->withPivot('content', 'order');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Helper Methods
    public function getContent($key = null, $default = null)
    {
        if ($key === null) {
            return $this->content;
        }
        return data_get($this->content, $key, $default);
    }
} 