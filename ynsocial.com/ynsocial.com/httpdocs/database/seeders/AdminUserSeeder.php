<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'info@ynsocial.com',
            'password' => Hash::make('YnSocial2024!'),
            'role' => 'admin',
        ]);
    }
} 