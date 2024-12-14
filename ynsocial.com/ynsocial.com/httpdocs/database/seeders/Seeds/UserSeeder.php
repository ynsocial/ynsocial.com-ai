<?php

namespace Database\Seeders\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    static string $table = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table(static::$table)->truncate();

        User::create([
            'name'           => 'Ynsocial',
            'email'          => 'master@ynsocial.com',
            'password'       => Hash::make('yn0909!'),
            'remember_token' => Str::random(10),
        ]);


    }
}
