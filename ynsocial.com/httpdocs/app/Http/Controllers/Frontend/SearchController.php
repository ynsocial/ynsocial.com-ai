<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $startTime = microtime(true);

        if (empty($query)) {
            return view('montoya.search', [
                'query' => '',
                'results' => collect([]),
                'searchTime' => 0,
            ]);
        }

        // Search in blog posts
        $blogPosts = BlogPost::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhere('excerpt', 'like', "%{$query}%")
            ->with(['category'])
            ->get()
            ->map(function ($post) {
                return [
                    'type' => 'blog',
                    'type_color' => 'info',
                    'title' => $post->title,
                    'url' => route('blog.show', $post->slug),
                    'highlight' => $this->generateHighlight($post->content),
                    'created_at' => $post->created_at,
                    'category' => optional($post->category)->name,
                ];
            });

        // Search in portfolio items
        $portfolioItems = Portfolio::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'portfolio',
                    'type_color' => 'primary',
                    'title' => $item->title,
                    'url' => route('portfolio.show', $item->slug),
                    'highlight' => $this->generateHighlight($item->description),
                    'created_at' => $item->created_at,
                    'category' => null,
                ];
            });

        // Search in services
        $services = Service::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get()
            ->map(function ($service) {
                return [
                    'type' => 'service',
                    'type_color' => 'success',
                    'title' => $service->title,
                    'url' => route('services') . '#' . $service->slug,
                    'highlight' => $this->generateHighlight($service->description),
                    'created_at' => $service->created_at,
                    'category' => null,
                ];
            });

        // Combine all results
        $results = $blogPosts->concat($portfolioItems)
            ->concat($services)
            ->sortByDesc('created_at')
            ->values();

        // Calculate search time
        $searchTime = microtime(true) - $startTime;

        return view('montoya.search', [
            'query' => $query,
            'results' => $results->paginate(10),
            'searchTime' => $searchTime,
        ]);
    }

    private function generateHighlight($content, $length = 200)
    {
        // Strip HTML tags
        $text = strip_tags($content);
        
        // Truncate to the specified length
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length) . '...';
        }

        return $text;
    }
} 