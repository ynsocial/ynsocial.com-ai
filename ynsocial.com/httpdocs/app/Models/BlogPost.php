<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'category_id',
        'user_id',
        'status',
        'active',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('active', true)
                    ->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors & Mutators
    public function getReadTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200); // Assuming average reading speed of 200 words per minute
        return $minutes;
    }

    public function getExcerptAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        
        $excerpt = strip_tags($this->content);
        return \Str::limit($excerpt, 150);
    }

    // Helper Methods
    public function getUrl()
    {
        return route('blog.show', $this->slug);
    }

    public function getCategoryUrl()
    {
        return $this->category ? route('blog.category', $this->category->slug) : '#';
    }

    public function getTagUrls()
    {
        return $this->tags->map(function($tag) {
            return [
                'name' => $tag->name,
                'url' => route('blog.tag', $tag->slug)
            ];
        });
    }

    public function getFeaturedImageUrl()
    {
        return $this->featured_image 
            ? asset('storage/' . $this->featured_image)
            : asset('images/default-post.jpg');
    }
} 