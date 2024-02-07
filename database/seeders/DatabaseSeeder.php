<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleTypeSeeder::class,
            VehicleMarqueSeeder::class,
            PostSeeder::class,
            VehicleModelSeeder::class,
        ]);
    }
}
