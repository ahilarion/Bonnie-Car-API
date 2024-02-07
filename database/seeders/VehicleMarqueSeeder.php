<?php

namespace Database\Seeders;

use App\Models\API\VehicleMarque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleMarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleMarque::factory()
            ->count(10)
            ->create();
    }
}
