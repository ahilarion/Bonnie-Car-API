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
                    'https://www.bike-zone.fr/images/700x476/ressources/catalogue_etendu_22/items/superbe_yamaha_mt07_night_fluo_a2_abs_de_avril_2017_garantie-aexh.jpg',
                    'https://www.casquedemoto.com/images/acheter-une-moto-d-occasion-870x559.png',
                    'https://bellesmachines.com/wp-content/uploads/2018/08/04-triump-bobber-black-1000.jpg'
                ];
            } else {
                $images = [
                    'https://static.actu.fr/uploads/2023/11/ferarri-960x640.png',
                    'https://images.caradisiac.com/images/2/5/1/3/202513/S0-le-classement-mondial-des-marques-automobiles-de-luxe-756694.jpg',
                    'https://images.caradisiac.com/images/0/6/7/5/200675/S0-la-plus-bath-des-batmoobiles-s-expose-a-lyon-745957.jpg'                ];
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
