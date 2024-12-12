<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Seeds\EnvelopeSeeder;
use Database\Seeders\Seeds\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            EnvelopeSeeder::class,
            AdminUserSeeder::class,
            ThemeSettingsSeeder::class,
        ]);
    }
}
