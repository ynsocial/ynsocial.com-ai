<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio listing page.
     */
    public function index(): View
    {
        $categories = PortfolioCategory::withCount('portfolios')->orderBy('order')->get();
        $portfolios = Portfolio::with('category')
            ->active()
            ->orderBy('order')
            ->paginate(12);

        return view('themes.montoya.portfolio', compact('categories', 'portfolios'));
    }

    /**
     * Display the specified portfolio.
     */
    public function show(string $slug): View
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        $related_portfolios = Portfolio::active()
            ->where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('themes.montoya.portfolio-single', compact('portfolio', 'related_portfolios'));
    }

    /**
     * Display portfolios by category.
     */
    public function category(string $slug): View
    {
        $category = PortfolioCategory::where('slug', $slug)->firstOrFail();
        $categories = PortfolioCategory::withCount('portfolios')->orderBy('order')->get();
        $portfolios = Portfolio::with('category')
            ->where('category_id', $category->id)
            ->active()
            ->orderBy('order')
            ->paginate(12);

        return view('themes.montoya.portfolio', compact('category', 'categories', 'portfolios'));
    }
} 