<?php

namespace Database\Seeders;

use App\Models\API\VehicleMarque;
use App\Models\API\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marques = VehicleMarque::all();

        $marques->each(function ($marque) {
            // add random VehicleType to each VehicleModel
            $marque->VehicleModels()->createMany(
                VehicleModel::factory()
                    ->count(10)
                    ->make()
                    ->toArray()
            );
        });
    }
}
