<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory()
            ->count(200)
            ->create();

        User::factory()
            ->count(500)
            ->create();

        Vehicle::factory()
            ->count(200)
            ->create();

        $vehicles = Vehicle::all();

        $users = User::all();

        //create post
        foreach ($vehicles as $vehicle) {
            if ($vehicle->is_two_wheeled) {
                $images = [
                    'https://source.unsplash.com/1600x900/?motorcycle',
                    'https://source.unsplash.com/1600x900/?motorcycle',
                    'https://source.unsplash.com/1600x900/?motorcycle',
                ];
            } else {
                $images = [
                    'https://source.unsplash.com/1600x900/?car',
                    'https://source.unsplash.com/1600x900/?car',
                    'https://source.unsplash.com/1600x900/?car',
                ];
            }


            $vehicle->post()->create([
                'title' => $vehicle->constructor . ' ' . $vehicle->model,
                'description' => $vehicle->description,
                'price' => $vehicle->original_price * (rand(80, 120) / 100),
                'images' => json_encode($images),
                'user_uuid' => $users->random()->uuid,
                'vehicle_uuid' => $vehicle->uuid,
            ]);
        }
    }
}
