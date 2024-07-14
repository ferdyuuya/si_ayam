<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Admin',
            'email' => 'admin@example.net',
            'password' => Hash::make('1234'),
            'status' => false
        ]);

        User::create([
            'name' => 'Jono Pengurus',
            'email' => 'pengurus@example.net',
            'password' => Hash::make('1234'),
            'status' => true
        ]);
    }
}
