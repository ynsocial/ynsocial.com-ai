<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'sections',
        'meta',
        'active',
        'order'
    ];

    protected $casts = [
        'sections' => 'array',
        'meta' => 'array',
        'active' => 'boolean'
    ];

    // Relationships
    public function sections()
    {
        return $this->belongsToMany(PageSection::class, 'page_section_pivot')
                    ->withPivot('content', 'order')
                    ->orderBy('page_section_pivot.order');
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

    // Helper Methods
    public function getSectionContent($sectionType)
    {
        return $this->sections()->where('type', $sectionType)->first()?->pivot->content 
            ?? $this->sections[$sectionType] 
            ?? null;
    }

    public function getMetaValue($key, $default = null)
    {
        return data_get($this->meta, $key, $default);
    }

    public function getUrl()
    {
        return route('page.show', $this->slug);
    }
}
