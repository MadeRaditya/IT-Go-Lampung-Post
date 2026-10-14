<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin IT Support',
            'email' => 'admin@lampost.co',
            'password' => Hash::make('Lampost108_@@'),
            'role' => 'admin',
            'department' => 'IT Department',
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@lampost.co',
            'password' => Hash::make('budi#123'),
            'role' => 'user',
            'department' => 'Finance & Accounting',
            'phone_number' => '089876543210',
        ]);
    }
}
