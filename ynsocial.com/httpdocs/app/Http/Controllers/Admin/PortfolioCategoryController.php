<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        PortfolioCategory::create($request->all());
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category created successfully');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio-categories.edit', compact('portfolioCategory'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:portfolio_categories,slug,' . $portfolioCategory->id
        ]);

        $portfolioCategory->update($request->all());
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->delete();
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category deleted successfully');
    }
}
