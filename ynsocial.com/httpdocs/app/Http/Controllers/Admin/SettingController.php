<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(): View
    {
        $settings = $this->getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // General Settings
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string',
            'site_keywords' => 'nullable|string',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:1024',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',

            // Social Media
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',

            // Theme Settings
            'theme_primary_color' => 'required|string|max:7',
            'theme_secondary_color' => 'nullable|string|max:7',
            'theme_font_family' => 'required|string|max:50',
            'theme_enable_dark_mode' => 'boolean',

            // Footer Settings
            'footer_text' => 'nullable|string',
            'footer_copyright' => 'required|string',

            // Analytics
            'google_analytics_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',

            // API Keys
            'google_maps_key' => 'nullable|string',
            'recaptcha_site_key' => 'nullable|string',
            'recaptcha_secret_key' => 'nullable|string',
        ]);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $this->deleteOldFile('site_logo');
            $validated['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $this->deleteOldFile('site_favicon');
            $validated['site_favicon'] = $request->file('site_favicon')->store('settings', 'public');
        }

        // Update settings
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Clear settings cache
        $this->clearCache();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Get all settings.
     */
    private function getSettings(): array
    {
        return Cache::remember('site_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear settings cache.
     */
    private function clearCache(): void
    {
        Cache::forget('site_settings');
    }

    /**
     * Delete old file if exists.
     */
    private function deleteOldFile(string $key): void
    {
        $oldFile = Setting::where('key', $key)->value('value');
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile);
        }
    }

    /**
     * Export settings.
     */
    public function export(): RedirectResponse
    {
        $settings = Setting::all()->toArray();
        $filename = 'settings-' . date('Y-m-d') . '.json';
        
        return response()->json($settings)
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }

    /**
     * Import settings.
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'settings_file' => 'required|file|mimes:json|max:2048'
        ]);

        $settings = json_decode(file_get_contents($request->file('settings_file')), true);

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }

        $this->clearCache();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings imported successfully.');
    }
} 