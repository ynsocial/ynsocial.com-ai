<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display the services page.
     */
    public function index(): View
    {
        $services = Service::active()->orderBy('order')->paginate(9);
        return view('themes.montoya.services', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $related_services = Service::active()
            ->where('id', '!=', $service->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('themes.montoya.service-single', compact('service', 'related_services'));
    }
} 