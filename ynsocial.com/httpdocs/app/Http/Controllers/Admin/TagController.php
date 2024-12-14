<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('blogPosts')
            ->latest()
            ->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:blog',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
        ]);

        $validated['slug'] = Str::slug($request->name);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.form', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:blog',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
        ]);

        $validated['slug'] = Str::slug($request->name);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        // Detach all blog posts before deleting
        $tag->blogPosts()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }

    public function merge(Request $request)
    {
        $request->validate([
            'source_tag_id' => 'required|exists:tags,id',
            'target_tag_id' => [
                'required',
                'exists:tags,id',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value == $request->source_tag_id) {
                        $fail('Source and target tags cannot be the same.');
                    }
                },
            ],
        ]);

        $sourceTag = Tag::findOrFail($request->source_tag_id);
        $targetTag = Tag::findOrFail($request->target_tag_id);

        // Get all blog posts from source tag
        $blogPosts = $sourceTag->blogPosts;

        // Attach all blog posts to target tag
        foreach ($blogPosts as $post) {
            if (!$post->tags->contains($targetTag->id)) {
                $post->tags()->attach($targetTag->id);
            }
        }

        // Delete source tag
        $sourceTag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tags merged successfully.');
    }
} 