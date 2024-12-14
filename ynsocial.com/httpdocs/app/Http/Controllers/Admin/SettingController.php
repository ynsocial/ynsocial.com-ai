<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable',
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Clear settings cache
        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    public function updateSocialMedia(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'social_' . $key],
                ['value' => $value, 'group' => 'social']
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Social media settings updated successfully.');
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'business_hours' => 'nullable|string',
            'google_maps_embed' => 'nullable|string',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'contact_' . $key],
                ['value' => $value, 'group' => 'contact']
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Contact settings updated successfully.');
    }

    public function updateSeo(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'google_analytics_id' => 'nullable|string',
            'google_tag_manager_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'robots_txt' => 'nullable|string',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'seo_' . $key],
                ['value' => $value, 'group' => 'seo']
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'SEO settings updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|integer',
            'smtp_username' => 'required|string',
            'smtp_password' => 'required|string',
            'smtp_encryption' => 'required|in:tls,ssl',
            'from_address' => 'required|email',
            'from_name' => 'required|string',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'email_' . $key],
                ['value' => $value, 'group' => 'email']
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Email settings updated successfully.');
    }

    public function updateApi(Request $request)
    {
        $request->validate([
            'google_maps_key' => 'nullable|string',
            'recaptcha_site_key' => 'nullable|string',
            'recaptcha_secret_key' => 'nullable|string',
            'mailchimp_api_key' => 'nullable|string',
            'mailchimp_list_id' => 'nullable|string',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'api_' . $key],
                ['value' => $value, 'group' => 'api']
            );
        }

        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'API settings updated successfully.');
    }
} 