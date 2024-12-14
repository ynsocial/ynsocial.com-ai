<?php

namespace Database\Seeders;

use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;

class ThemeSettingsSeeder extends Seeder
{
    public function run()
    {
        if (!ThemeSetting::count()) {
            ThemeSetting::create(ThemeSetting::getDefaults());
        }
    }
} 