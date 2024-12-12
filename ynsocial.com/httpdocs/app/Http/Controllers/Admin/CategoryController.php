<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['blogPosts', 'portfolios', 'services'])
            ->latest()
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $types = ['blog', 'portfolio', 'service'];
        return view('admin.categories.form', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:blog,portfolio,service',
            'parent_id' => 'nullable|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $types = ['blog', 'portfolio', 'service'];
        $parentCategories = Category::where('id', '!=', $category->id)
            ->where('type', $category->type)
            ->get();

        return view('admin.categories.form', compact('category', 'types', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:blog,portfolio,service',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($category) {
                    if ($value == $category->id) {
                        $fail('A category cannot be its own parent.');
                    }
                },
            ],
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if category has any posts, portfolios, or services
        if ($category->blogPosts()->exists() || 
            $category->portfolios()->exists() || 
            $category->services()->exists()) {
            return back()->with('error', 'Cannot delete category with associated items.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:categories,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            Category::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Categories reordered successfully.']);
    }
} 