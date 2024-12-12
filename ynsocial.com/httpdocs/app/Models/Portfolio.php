<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'image',
        'meta_description',
        'meta_keywords',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
} 