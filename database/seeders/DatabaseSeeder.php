<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ternak;
use App\Models\Pangan;
use App\Models\TambahPangan;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::create([
            'name' => 'John Admin',
            'email' => 'jono@gmail.com',
            'password' => Hash::make('1234'),
            'status' => false
        ]);

        User::create([
            'name' => 'Jono Pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => Hash::make('1234'),
            'status' => true
        ]);

        Pangan::create([
            'stok_sekarang' => 0,
            'updated_by' => 1,
        ]);
        TambahPangan::create([
            'stok_id' => 1,
            'updated_by' => 1,
        ]);

        $faker = Factory::create();

        // for ($i = 1; $i <= 20; $i++) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => Hash::make('1234'),
        //         'status' => $faker->boolean
        //     ]);
        // }

        // for ($i = 1; $i <= 100; $i++) {
        //     Ternak::create([
        //         'total_awal_ayam' => rand(2000, 10000),
        //         'ayam_mati' => rand(0, 100),
        //         'ayam_sakit' => rand(0, 100),
        //         'ayam_berhasil' => rand(0, 100),
        //         'total_ayam' => rand(0, 100),
        //         'is_ongoing' => false,
        //     ]);
        // }

        // for ($i = 1; $i <= 200; $i++) {
        //     Pangan::create([
        //         'pemasukan_stok' => rand(1, 1000),
        //         'stok_sekarang' => rand(1, 1000),
        //         'id_ternak' => rand(1, 100),
        //         'update_pangan' => $faker->dateTimeThisYear,
        //         'updated_by' => $faker->name,

        //     ]);
        // }
    }
}
