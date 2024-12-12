<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['category'])
            ->latest()
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::where('type', 'service')->get();
        return view('admin.services.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'icon' => 'nullable|max:50',
            'featured_image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('services', 'public');
        }

        if ($request->has('features')) {
            $validated['features'] = json_encode($request->features);
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = Category::where('type', 'service')->get();
        return view('admin.services.form', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'icon' => 'nullable|max:50',
            'featured_image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('services', 'public');
        }

        if ($request->has('features')) {
            $validated['features'] = json_encode($request->features);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function categories()
    {
        $categories = Category::where('type', 'service')
            ->withCount('services')
            ->get();

        return view('admin.services.categories.index', compact('categories'));
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:services,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            Service::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Services reordered successfully.']);
    }
} 