<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::with('sections')
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        // Get additional data needed for sections
        $data = $this->getPageData($page);

        return view('montoya.' . $slug, compact('page', 'data'));
    }

    private function getPageData(Page $page)
    {
        $data = [];

        foreach ($page->sections as $section) {
            switch ($section->type) {
                case 'services':
                    $data['services'] = \App\Models\Service::active()->ordered()->get();
                    break;
                
                case 'team':
                    $data['team'] = \App\Models\Team::active()->ordered()->get();
                    break;

                case 'portfolio':
                    $data['featuredPortfolio'] = \App\Models\Portfolio::featured()->active()->limit(6)->get();
                    break;

                case 'blog':
                    $data['latestPosts'] = \App\Models\BlogPost::published()->latest()->limit(3)->get();
                    break;

                case 'stats':
                    $data['stats'] = (object)[
                        'clients' => \App\Models\Client::count(),
                        'projects' => \App\Models\Portfolio::count(),
                        'awards' => $section->getContent('awards', 0),
                        'experience' => $section->getContent('experience', 0)
                    ];
                    break;
            }
        }

        return $data;
    }
} 