<?php

namespace Database\Seeders\Seeds;

use App\Models\Envelope;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnvelopeSeeder extends Seeder
{
    static string $table = 'envelopes';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table(static::$table)->truncate();

        Envelope::factory(12)->create();


    }
}
