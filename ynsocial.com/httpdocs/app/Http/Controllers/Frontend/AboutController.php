<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Team;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index(): View
    {
        $page = Page::where('slug', 'about')->firstOrFail();
        $team_members = Team::active()->orderBy('order')->get();

        return view('themes.montoya.about', compact('page', 'team_members'));
    }
} 