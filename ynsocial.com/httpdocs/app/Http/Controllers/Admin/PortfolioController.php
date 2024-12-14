<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Traits\OptimizedQueries;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Exception;

class PortfolioController extends BaseController
{
    use OptimizedQueries;

    /**
     * Cache key for portfolio list
     */
    private const PORTFOLIO_LIST_KEY = 'portfolios:list';

    /**
     * Cache key for portfolio categories
     */
    private const PORTFOLIO_CATEGORIES_KEY = 'portfolios:categories';

    /**
     * Allowed image types
     */
    private const ALLOWED_IMAGE_TYPES = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    /**
     * Display a listing of portfolios.
     */
    public function index(Request $request): View
    {
        try {
            $query = Portfolio::with('category');

            // Apply filters
            if ($request->has('category')) {
                $query->where('category_id', $request->category);
            }

            if ($request->has('status')) {
                $query->where('active', $request->status === 'active');
            }

            if ($request->has('featured')) {
                $query->where('featured', $request->featured === 'yes');
            }

            // Apply search
            if ($request->has('search')) {
                $query->efficientSearch($request->search, ['title', 'description', 'client']);
            }

            // Apply sorting
            $sort = $request->sort ?? 'order';
            $direction = $request->direction ?? 'asc';
            $query->efficientOrderBy($sort, $direction);

            // Get paginated results with optimization
            $portfolios = $query->withCommonRelations()
                ->selectOptimized()
                ->efficientPagination($this->perPage);

            // Get categories from cache
            $categories = $this->getCachedData(self::PORTFOLIO_CATEGORIES_KEY, function () {
                return PortfolioCategory::orderBy('name')->get();
            });

            // Log activity
            $this->logActivity('Portfolio list viewed', [
                'filters' => $request->only(['category', 'status', 'featured', 'search', 'sort', 'direction']),
                'results_count' => $portfolios->count()
            ]);

            return view('admin.portfolio.index', compact('portfolios', 'categories'));
        } catch (Exception $e) {
            $this->logActivity('Portfolio list error', ['error' => $e->getMessage()]);
            return view('admin.portfolio.error', ['error' => 'Unable to load portfolio list']);
        }
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create(): View
    {
        try {
            $categories = $this->getCachedData(self::PORTFOLIO_CATEGORIES_KEY, function () {
                return PortfolioCategory::orderBy('name')->get();
            });

            return view('admin.portfolio.create', compact('categories'));
        } catch (Exception $e) {
            $this->logActivity('Portfolio create form error', ['error' => $e->getMessage()]);
            return view('admin.portfolio.error', ['error' => 'Unable to load create form']);
        }
    }

    /**
     * Store a newly created portfolio.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate input
            $validated = $this->validateAndSanitize($request->all(), [
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:portfolios',
                'description' => 'nullable|string',
                'content' => 'required|string',
                'category_id' => 'required|exists:portfolio_categories,id',
                'image' => 'required|image|max:2048|dimensions:min_width=800,min_height=600',
                'gallery' => 'nullable|array',
                'gallery.*' => 'image|max:2048|dimensions:min_width=800,min_height=600',
                'client' => 'nullable|string|max:255',
                'completion_date' => 'nullable|date',
                'website' => 'nullable|url|max:255',
                'featured' => 'boolean',
                'active' => 'boolean',
                'order' => 'integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string|max:255',
                'og_image' => 'nullable|image|max:2048|dimensions:width=1200,height=630',
            ]);

            return $this->handleDatabaseOperation(function () use ($validated, $request) {
                // Handle slug
                $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

                // Handle main image
                if ($request->hasFile('image')) {
                    $validated['image'] = $this->handleImageUpload(
                        $request->file('image'),
                        'portfolios',
                        800,
                        600
                    );
                }

                // Handle gallery images
                if ($request->hasFile('gallery')) {
                    $gallery = [];
                    foreach ($request->file('gallery') as $image) {
                        $gallery[] = $this->handleImageUpload(
                            $image,
                            'portfolios/gallery',
                            800,
                            600
                        );
                    }
                    $validated['gallery'] = json_encode($gallery);
                }

                // Handle OG image
                if ($request->hasFile('og_image')) {
                    $validated['og_image'] = $this->handleImageUpload(
                        $request->file('og_image'),
                        'portfolios/og',
                        1200,
                        630
                    );
                }

                // Create portfolio
                $portfolio = Portfolio::create($validated);

                // Clear cache
                $this->clearCache(self::PORTFOLIO_LIST_KEY);

                // Log activity
                $this->logActivity('Portfolio created', [
                    'portfolio_id' => $portfolio->id,
                    'title' => $portfolio->title
                ]);

                return redirect()
                    ->route('admin.portfolio.index')
                    ->with('success', 'Portfolio created successfully.');
            });
        } catch (Exception $e) {
            $this->logActivity('Portfolio creation error', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Failed to create portfolio: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit(Portfolio $portfolio): View
    {
        try {
            $categories = $this->getCachedData(self::PORTFOLIO_CATEGORIES_KEY, function () {
                return PortfolioCategory::orderBy('name')->get();
            });

            return view('admin.portfolio.edit', compact('portfolio', 'categories'));
        } catch (Exception $e) {
            $this->logActivity('Portfolio edit form error', [
                'portfolio_id' => $portfolio->id,
                'error' => $e->getMessage()
            ]);
            return view('admin.portfolio.error', ['error' => 'Unable to load edit form']);
        }
    }

    /**
     * Update the specified portfolio.
     */
    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        try {
            // Validate input
            $validated = $this->validateAndSanitize($request->all(), [
                'title' => 'required|string|max:255',
                'slug' => ['nullable', 'string', 'max:255', Rule::unique('portfolios')->ignore($portfolio)],
                'description' => 'nullable|string',
                'content' => 'required|string',
                'category_id' => 'required|exists:portfolio_categories,id',
                'image' => 'nullable|image|max:2048|dimensions:min_width=800,min_height=600',
                'gallery' => 'nullable|array',
                'gallery.*' => 'image|max:2048|dimensions:min_width=800,min_height=600',
                'client' => 'nullable|string|max:255',
                'completion_date' => 'nullable|date',
                'website' => 'nullable|url|max:255',
                'featured' => 'boolean',
                'active' => 'boolean',
                'order' => 'integer',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string|max:255',
                'og_image' => 'nullable|image|max:2048|dimensions:width=1200,height=630',
                'remove_gallery' => 'nullable|array',
                'remove_gallery.*' => 'string',
            ]);

            return $this->handleDatabaseOperation(function () use ($validated, $request, $portfolio) {
                // Handle slug
                $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

                // Handle main image
                if ($request->hasFile('image')) {
                    // Delete old image
                    if ($portfolio->image) {
                        Storage::disk('public')->delete($portfolio->image);
                    }

                    $validated['image'] = $this->handleImageUpload(
                        $request->file('image'),
                        'portfolios',
                        800,
                        600
                    );
                }

                // Handle gallery images
                if ($request->hasFile('gallery')) {
                    $currentGallery = json_decode($portfolio->gallery ?? '[]', true);
                    
                    // Remove selected images
                    if ($request->has('remove_gallery')) {
                        foreach ($request->remove_gallery as $image) {
                            Storage::disk('public')->delete($image);
                            $currentGallery = array_diff($currentGallery, [$image]);
                        }
                    }

                    // Add new images
                    foreach ($request->file('gallery') as $image) {
                        $currentGallery[] = $this->handleImageUpload(
                            $image,
                            'portfolios/gallery',
                            800,
                            600
                        );
                    }

                    $validated['gallery'] = json_encode(array_values($currentGallery));
                }

                // Handle OG image
                if ($request->hasFile('og_image')) {
                    // Delete old OG image
                    if ($portfolio->og_image) {
                        Storage::disk('public')->delete($portfolio->og_image);
                    }

                    $validated['og_image'] = $this->handleImageUpload(
                        $request->file('og_image'),
                        'portfolios/og',
                        1200,
                        630
                    );
                }

                // Update portfolio
                $portfolio->update($validated);

                // Clear cache
                $this->clearCache(self::PORTFOLIO_LIST_KEY);

                // Log activity
                $this->logActivity('Portfolio updated', [
                    'portfolio_id' => $portfolio->id,
                    'title' => $portfolio->title
                ]);

                return redirect()
                    ->route('admin.portfolio.index')
                    ->with('success', 'Portfolio updated successfully.');
            });
        } catch (Exception $e) {
            $this->logActivity('Portfolio update error', [
                'portfolio_id' => $portfolio->id,
                'error' => $e->getMessage()
            ]);
            return back()->withInput()->with('error', 'Failed to update portfolio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified portfolio.
     */
    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        try {
            return $this->handleDatabaseOperation(function () use ($portfolio) {
                // Delete main image
                if ($portfolio->image) {
                    Storage::disk('public')->delete($portfolio->image);
                }

                // Delete gallery images
                if ($portfolio->gallery) {
                    $gallery = json_decode($portfolio->gallery, true);
                    foreach ($gallery as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }

                // Delete OG image
                if ($portfolio->og_image) {
                    Storage::disk('public')->delete($portfolio->og_image);
                }

                $portfolio->delete();

                // Clear cache
                $this->clearCache(self::PORTFOLIO_LIST_KEY);

                // Log activity
                $this->logActivity('Portfolio deleted', [
                    'portfolio_id' => $portfolio->id,
                    'title' => $portfolio->title
                ]);

                return redirect()
                    ->route('admin.portfolio.index')
                    ->with('success', 'Portfolio deleted successfully.');
            });
        } catch (Exception $e) {
            $this->logActivity('Portfolio deletion error', [
                'portfolio_id' => $portfolio->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to delete portfolio: ' . $e->getMessage());
        }
    }

    /**
     * Update the order of portfolios.
     */
    public function reorder(Request $request): RedirectResponse
    {
        try {
            $validated = $this->validateAndSanitize($request->all(), [
                'items' => 'required|array',
                'items.*' => 'exists:portfolios,id',
            ]);

            return $this->handleDatabaseOperation(function () use ($validated) {
                foreach ($validated['items'] as $index => $id) {
                    Portfolio::where('id', $id)->update(['order' => $index]);
                }

                // Clear cache
                $this->clearCache(self::PORTFOLIO_LIST_KEY);

                // Log activity
                $this->logActivity('Portfolio order updated', [
                    'items' => $validated['items']
                ]);

                return response()->json(['message' => 'Order updated successfully.']);
            });
        } catch (Exception $e) {
            $this->logActivity('Portfolio reorder error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update order'], 500);
        }
    }

    /**
     * Generate SEO-friendly slug from title.
     */
    public function generateSlug(Request $request): RedirectResponse
    {
        try {
            $validated = $this->validateAndSanitize($request->all(), [
                'title' => 'required|string|max:255'
            ]);
            
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;

            while (Portfolio::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            return response()->json(['slug' => $slug]);
        } catch (Exception $e) {
            $this->logActivity('Slug generation error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to generate slug'], 500);
        }
    }

    /**
     * Handle image upload with optimization
     */
    private function handleImageUpload($file, string $path, int $width, int $height): string
    {
        // Validate file type
        if (!in_array($file->getMimeType(), self::ALLOWED_IMAGE_TYPES)) {
            throw new Exception('Invalid image type');
        }

        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.jpg';
        
        // Create optimized version
        $image = Image::make($file)
            ->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('jpg', 80);
        
        // Store optimized image
        Storage::disk('public')->put($path . '/' . $filename, $image);

        return $path . '/' . $filename;
    }
}