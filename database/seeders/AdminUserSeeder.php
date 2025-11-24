<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'vionitrisna05@gmail.com'],
            [
                'name' => 'trisna',
                'password' => Hash::make('bali2023'),
                'role' => 'admin',
            ]
        );
    }
}
