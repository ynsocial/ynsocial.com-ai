<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(): View
    {
        $posts = Blog::with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create(): View
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'required|image|max:2048',
            'published_at' => 'nullable|date',
            'featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Handle slug
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        // Create post
        $post = Blog::create($validated);

        // Sync tags
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(Blog $post): View
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.blog.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, Blog $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs')->ignore($post)],
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Handle slug
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        // Update post
        $post->update($validated);

        // Sync tags
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(Blog $post): RedirectResponse
    {
        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Delete post (tags will be automatically detached)
        $post->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Generate SEO-friendly slug from title.
     */
    public function generateSlug(Request $request): RedirectResponse
    {
        $request->validate(['title' => 'required|string|max:255']);
        
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return response()->json(['slug' => $slug]);
    }
} 