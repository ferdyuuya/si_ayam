<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'test@example.net',
            'password' => Hash::make('1234'),
            'status' => false
        ]);
        User::create([
            'name' => 'Pengurus',
            'email' => 'pengurus@email.com',
            'password' => Hash::make('1234'),
            'status' => true
        ]);
    }
}
