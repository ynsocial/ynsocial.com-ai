<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'category_id',
        'client',
        'completion_date',
        'website',
        'featured',
        'active',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
        'completion_date' => 'date',
    ];

    /**
     * Get the category that owns the portfolio.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class);
    }

    /**
     * Scope a query to only include active portfolios.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope a query to only include featured portfolios.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
} 