<?php

namespace Database\Seeders\Seeds;

use App\Models\Newsletter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewsletterSeeder extends Seeder
{
    static string $table = 'newsletters';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table(static::$table)->truncate();

        Newsletter::factory(12)->create();


    }
}
