<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Blog;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $featured_portfolios = Portfolio::featured()->latest()->take(6)->get();
        $services = Service::featured()->take(3)->get();
        $latest_posts = Blog::published()->latest()->take(3)->get();

        return view('themes.montoya.index', compact(
            'featured_portfolios',
            'services',
            'latest_posts'
        ));
    }
} 