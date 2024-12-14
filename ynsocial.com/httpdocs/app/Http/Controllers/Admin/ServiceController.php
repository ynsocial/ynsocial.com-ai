<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(): View
    {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'required|image|max:2048',
            'featured' => 'boolean',
            'active' => 'boolean',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Handle slug
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('services')->ignore($service)],
            'description' => 'nullable|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'featured' => 'boolean',
            'active' => 'boolean',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Handle slug
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        // Delete image
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Update the order of services.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:services,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            Service::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }

    /**
     * Upload a service icon.
     */
    public function uploadIcon(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'icon' => 'required|file|mimes:svg|max:100',
        ]);

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('services/icons', 'public');
            return response()->json(['path' => $path]);
        }

        return response()->json(['error' => 'No icon file provided.'], 400);
    }
} 