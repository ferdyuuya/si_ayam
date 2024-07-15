<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

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

        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('1234'),
                'status' => $faker->boolean
            ]);
        }
    }
}
