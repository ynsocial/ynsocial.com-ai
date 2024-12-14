<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
{
    public function settings()
    {
        $settings = ThemeSetting::first() ?? new ThemeSetting();
        $config = config('theme');
        
        return view('admin.theme.settings', compact('settings', 'config'));
    }

    public function update(Request $request)
    {
        $settings = ThemeSetting::first() ?? new ThemeSetting();
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $path = $request->file('logo')->store('theme/logo', 'public');
            $settings->logo = $path;
        }

        // Update theme settings
        $settings->fill([
            'colors' => $request->colors,
            'typography' => $request->typography,
            'header' => $request->header,
            'footer' => $request->footer,
            'portfolio' => $request->portfolio,
            'blog' => $request->blog,
            'homepage' => $request->homepage,
            'social_media' => $request->social_media,
            'custom_css' => $request->custom_css,
            'custom_js' => $request->custom_js,
        ]);
        
        $settings->save();

        // Clear theme cache
        $this->clearThemeCache();

        // Generate CSS if custom styles exist
        if ($request->custom_css) {
            $this->generateCustomCSS($settings);
        }

        return redirect()->back()->with('success', 'Theme settings updated successfully.');
    }

    public function preview()
    {
        $settings = ThemeSetting::first();
        return view('montoya.preview', compact('settings'));
    }

    public function export()
    {
        $settings = ThemeSetting::first();
        $filename = 'theme-settings-' . date('Y-m-d') . '.json';
        
        $exportData = $settings->toArray();
        // Remove sensitive or unnecessary data
        unset($exportData['id'], $exportData['created_at'], $exportData['updated_at']);
        
        return response()->json($exportData)
            ->header('Content-Disposition', 'attachment; filename=' . $filename);
    }

    public function import(Request $request)
    {
        $request->validate([
            'settings_file' => 'required|file|mimes:json'
        ]);

        try {
            $content = json_decode(file_get_contents($request->file('settings_file')), true);
            
            if (!$content) {
                throw new \Exception('Invalid JSON file');
            }

            $settings = ThemeSetting::first() ?? new ThemeSetting();
            
            foreach ($content as $key => $value) {
                if ($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at') {
                    $settings->$key = $value;
                }
            }
            
            $settings->save();
            
            // Clear theme cache
            $this->clearThemeCache();

            return redirect()->back()->with('success', 'Theme settings imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing settings: ' . $e->getMessage());
        }
    }

    public function resetToDefault()
    {
        $settings = ThemeSetting::first() ?? new ThemeSetting();
        $defaults = ThemeSetting::getDefaults();
        
        foreach ($defaults as $key => $value) {
            $settings->$key = $value;
        }
        
        $settings->save();
        
        // Clear theme cache
        $this->clearThemeCache();

        return redirect()->back()->with('success', 'Theme settings reset to defaults.');
    }

    public function applyLayout(Request $request)
    {
        $request->validate([
            'layout' => 'required|string'
        ]);

        $settings = ThemeSetting::first() ?? new ThemeSetting();
        $layouts = config('theme.layouts');

        if (!isset($layouts[$request->layout])) {
            return redirect()->back()->with('error', 'Invalid layout selected.');
        }

        $layoutSettings = $layouts[$request->layout];
        
        // Apply layout settings
        $settings->header = array_merge($settings->header ?? [], $layoutSettings['header'] ?? []);
        $settings->footer = array_merge($settings->footer ?? [], $layoutSettings['footer'] ?? []);
        
        $settings->save();
        
        // Clear theme cache
        $this->clearThemeCache();

        return redirect()->back()->with('success', 'Layout applied successfully.');
    }

    protected function clearThemeCache()
    {
        Cache::tags(['theme', 'theme-settings'])->flush();
    }

    protected function generateCustomCSS($settings)
    {
        $css = $settings->custom_css;
        $path = public_path('montoya/css/custom.css');
        
        File::put($path, $css);
    }
} 