<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['category', 'author', 'tags'])
            ->latest()
            ->paginate(10);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('type', 'blog')->get();
        $tags = Tag::where('type', 'blog')->get();
        return view('admin.blog.form', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blog', 'public');
        }

        $post = BlogPost::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        $categories = Category::where('type', 'blog')->get();
        $tags = Tag::where('type', 'blog')->get();
        return view('admin.blog.form', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blog', 'public');
        }

        $blog->update($validated);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function categories()
    {
        $categories = Category::where('type', 'blog')
            ->withCount('blogPosts')
            ->get();

        return view('admin.blog.categories.index', compact('categories'));
    }

    public function tags()
    {
        $tags = Tag::where('type', 'blog')
            ->withCount('blogPosts')
            ->get();

        return view('admin.blog.tags.index', compact('tags'));
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:blog_posts,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            BlogPost::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Posts reordered successfully.']);
    }
} 