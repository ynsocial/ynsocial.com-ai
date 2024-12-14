<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class DashboardController extends BaseController
{
    /**
     * Cache key for dashboard metrics
     */
    private const DASHBOARD_METRICS_KEY = 'dashboard:metrics';

    /**
     * Cache key for recent activities
     */
    private const RECENT_ACTIVITIES_KEY = 'dashboard:activities';

    /**
     * Display the dashboard with metrics.
     */
    public function index(): View
    {
        try {
            // Get metrics with error handling
            $metrics = $this->handleDatabaseOperation(function () {
                return $this->getCachedData(self::DASHBOARD_METRICS_KEY, function () {
                    return [
                        'portfolios' => $this->getPortfolioMetrics(),
                        'services' => $this->getServiceMetrics(),
                        'blog' => $this->getBlogMetrics(),
                        'contacts' => $this->getContactMetrics(),
                        'newsletter' => $this->getNewsletterMetrics(),
                        'users' => $this->getUserMetrics(),
                    ];
                });
            });

            // Get recent activities with error handling
            $activities = $this->handleDatabaseOperation(function () {
                return $this->getCachedData(self::RECENT_ACTIVITIES_KEY, function () {
                    return $this->getRecentActivities();
                });
            });

            // Get performance metrics
            $performance = $this->getPerformanceMetrics();

            // Get recent items with relationships and error handling
            $recent = $this->handleDatabaseOperation(function () {
                return [
                    'portfolios' => Portfolio::with('category')
                        ->latest()
                        ->take(5)
                        ->get(),
                    'messages' => Contact::with('user')
                        ->latest()
                        ->take(5)
                        ->get(),
                    'subscribers' => Newsletter::active()
                        ->latest()
                        ->take(5)
                        ->get(),
                    'posts' => Blog::with(['category', 'author'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ];
            });

            // Log dashboard access
            $this->logActivity('Dashboard accessed', [
                'metrics_cached' => Cache::has(self::DASHBOARD_METRICS_KEY),
                'activities_cached' => Cache::has(self::RECENT_ACTIVITIES_KEY)
            ]);

            return view('admin.dashboard.index', compact(
                'metrics',
                'activities',
                'performance',
                'recent'
            ));
        } catch (Exception $e) {
            // Log error and show error view
            $this->logActivity('Dashboard error', ['error' => $e->getMessage()]);
            return view('admin.dashboard.error', ['error' => 'Unable to load dashboard data']);
        }
    }

    /**
     * Get portfolio metrics
     */
    private function getPortfolioMetrics(): array
    {
        return [
            'total' => Portfolio::count(),
            'active' => Portfolio::active()->count(),
            'featured' => Portfolio::featured()->count(),
            'by_category' => Portfolio::select('category_id', DB::raw('count(*) as total'))
                ->groupBy('category_id')
                ->with('category')
                ->get(),
        ];
    }

    /**
     * Get service metrics
     */
    private function getServiceMetrics(): array
    {
        return [
            'total' => Service::count(),
            'active' => Service::active()->count(),
            'featured' => Service::featured()->count(),
        ];
    }

    /**
     * Get blog metrics
     */
    private function getBlogMetrics(): array
    {
        return [
            'total' => Blog::count(),
            'published' => Blog::published()->count(),
            'draft' => Blog::draft()->count(),
            'scheduled' => Blog::scheduled()->count(),
        ];
    }

    /**
     * Get contact metrics
     */
    private function getContactMetrics(): array
    {
        return [
            'total' => Contact::count(),
            'unread' => Contact::unread()->count(),
            'today' => Contact::whereDate('created_at', Carbon::today())->count(),
            'this_week' => Contact::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count(),
        ];
    }

    /**
     * Get newsletter metrics
     */
    private function getNewsletterMetrics(): array
    {
        return [
            'total_subscribers' => Newsletter::active()->count(),
            'recent_subscribers' => Newsletter::active()
                ->whereBetween('created_at', [
                    Carbon::now()->subDays(30),
                    Carbon::now()
                ])->count(),
            'unsubscribed' => Newsletter::whereNotNull('unsubscribed_at')->count(),
        ];
    }

    /**
     * Get user metrics
     */
    private function getUserMetrics(): array
    {
        return [
            'total' => User::count(),
            'active' => User::where('active', true)->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities(): array
    {
        $startDate = Carbon::now()->subDays(7);
        
        return [
            'portfolio_activities' => Portfolio::where('created_at', '>=', $startDate)
                ->orWhere('updated_at', '>=', $startDate)
                ->with('category')
                ->get()
                ->map(function ($item) use ($startDate) {
                    return [
                        'type' => 'portfolio',
                        'action' => $item->created_at >= $startDate ? 'created' : 'updated',
                        'item' => $item,
                        'date' => $item->created_at >= $startDate ? $item->created_at : $item->updated_at,
                    ];
                }),
            'service_activities' => Service::where('created_at', '>=', $startDate)
                ->orWhere('updated_at', '>=', $startDate)
                ->get()
                ->map(function ($item) use ($startDate) {
                    return [
                        'type' => 'service',
                        'action' => $item->created_at >= $startDate ? 'created' : 'updated',
                        'item' => $item,
                        'date' => $item->created_at >= $startDate ? $item->created_at : $item->updated_at,
                    ];
                }),
            'blog_activities' => Blog::where('created_at', '>=', $startDate)
                ->orWhere('updated_at', '>=', $startDate)
                ->with(['category', 'author'])
                ->get()
                ->map(function ($item) use ($startDate) {
                    return [
                        'type' => 'blog',
                        'action' => $item->created_at >= $startDate ? 'created' : 'updated',
                        'item' => $item,
                        'date' => $item->created_at >= $startDate ? $item->created_at : $item->updated_at,
                    ];
                }),
        ];
    }

    /**
     * Get performance metrics
     */
    private function getPerformanceMetrics(): array
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $sixtyDaysAgo = Carbon::now()->subDays(60);

        // Get current period metrics
        $currentPeriodMetrics = $this->handleDatabaseOperation(function () use ($thirtyDaysAgo) {
            return [
                'contacts' => Contact::where('created_at', '>=', $thirtyDaysAgo)->count(),
                'subscribers' => Newsletter::where('created_at', '>=', $thirtyDaysAgo)->count(),
                'portfolios' => Portfolio::where('created_at', '>=', $thirtyDaysAgo)->count(),
                'posts' => Blog::where('created_at', '>=', $thirtyDaysAgo)->count(),
            ];
        });

        // Get previous period metrics
        $previousPeriodMetrics = $this->handleDatabaseOperation(function () use ($thirtyDaysAgo, $sixtyDaysAgo) {
            return [
                'contacts' => Contact::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count(),
                'subscribers' => Newsletter::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count(),
                'portfolios' => Portfolio::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count(),
                'posts' => Blog::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count(),
            ];
        });

        // Calculate growth percentages
        return [
            'contacts_growth' => $this->calculateGrowth($previousPeriodMetrics['contacts'], $currentPeriodMetrics['contacts']),
            'subscribers_growth' => $this->calculateGrowth($previousPeriodMetrics['subscribers'], $currentPeriodMetrics['subscribers']),
            'portfolios_growth' => $this->calculateGrowth($previousPeriodMetrics['portfolios'], $currentPeriodMetrics['portfolios']),
            'posts_growth' => $this->calculateGrowth($previousPeriodMetrics['posts'], $currentPeriodMetrics['posts']),
        ];
    }

    /**
     * Calculate growth percentage between two periods
     */
    private function calculateGrowth(int $previous, int $current): float
    {
        if ($previous === 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 2);
    }

    /**
     * Clear dashboard cache
     */
    public function clearCache(): void
    {
        $this->clearCache(self::DASHBOARD_METRICS_KEY);
        $this->clearCache(self::RECENT_ACTIVITIES_KEY);
        
        $this->logActivity('Dashboard cache cleared');
    }
}
