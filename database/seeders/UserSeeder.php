<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'Admin@123',
                'phone' => '1234567890',
                'address' => 'GOA',
                'country' => '101',
                'state' => '12',
                'city' => '19',
                'zip' => '380008',
                'role' => 'Super Admin',
            ]
        );
    }
}
