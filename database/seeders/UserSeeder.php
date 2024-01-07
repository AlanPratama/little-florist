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
            'name' => 'Admin',
            'phone' => '085817000942',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'slug' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
        ]);
    }
}
