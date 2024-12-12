<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'tags'])
            ->where('active', true)
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9);
        $categories = Category::withCount('posts')->where('active', true)->get();
        $popularTags = Tag::withCount('posts')
            ->where('active', true)
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get();

        return view('montoya.blog.index', compact('posts', 'categories', 'popularTags'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'tags'])
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        // Get related posts based on category and tags
        $relatedPosts = BlogPost::with(['category'])
            ->where('active', true)
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('category_id', $post->category_id)
                    ->orWhereHas('tags', function($q) use ($post) {
                        $q->whereIn('id', $post->tags->pluck('id'));
                    });
            })
            ->limit(3)
            ->get();

        return view('montoya.blog.show', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        $posts = BlogPost::with(['category', 'tags'])
            ->where('category_id', $category->id)
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('montoya.blog.category', compact('category', 'posts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        $posts = $tag->posts()
            ->with(['category', 'tags'])
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('montoya.blog.tag', compact('tag', 'posts'));
    }
} 