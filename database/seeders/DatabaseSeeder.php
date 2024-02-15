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
                    'https://www.riders34.com/public/img/big/6d336cd6afe47a69989baf5de25e718f.jpg',
                    'https://www.motoracingservice.com/public/img/big/5jpg_61d5d1182fd5e.jpg',
                    'https://www.motoconcess.com/nas/commun/annonces/2f2c59a095fecdfd7bb380e20a43dde3202bc72b/photo-annonce-cf-moto-800-mt-a2_653bdd4a950b3353067921.jpg',
                    'https://www.scuderiamoto83.fr/public/img/big/P1070454JPG_5f12affee2f8d.JPG',
                    'https://www.motoconcess.com/nas/commun/annonces/FADCF81D58074A0E13112E45CAD7FA2417CCA3B3/photo-annonce-bmw-f800s_604b826da71bf667911060.jpg'
                ];
            } else {
                $images = [
                    'https://static.actu.fr/uploads/2023/11/ferarri-960x640.png',
                    'https://images.caradisiac.com/images/2/5/1/3/202513/S0-le-classement-mondial-des-marques-automobiles-de-luxe-756694.jpg',
                    'https://images.caradisiac.com/images/0/6/7/5/200675/S0-la-plus-bath-des-batmoobiles-s-expose-a-lyon-745957.jpg',
                    'https://images.caradisiac.com/images/7/7/9/1/197791/S0-le-prix-des-voitures-d-occasion-continuent-d-augmenter-724963.jpg',
                    'https://cdn-s-www.republicain-lorrain.fr/images/1EC992CF-2EA2-42E2-A62A-5E37C1B8A55D/NW_raw/la-peugeot-106-et-par-extension-la-saxo-se-trouvent-encore-en-occasion-la-plupart-du-temps-vendue-sans-controle-technique-photo-dr-1611656055.jpg',
                    'https://www.challenges.fr/assets/img/2015/03/04/cover-r4x3w1200-624bfc368759a-renault-clio-iii-elue-voiture-de-l-annee-2006.jpg'
                ];
            }


            $vehicle->post()->create([
                'title' => $vehicle->constructor . ' ' . $vehicle->model,
                'description' => $vehicle->description,
                'price' => $vehicle->original_price * (rand(80, 120) / 100),
                'images' => json_encode(array_slice($images, 0, 3)),
                'user_uuid' => $users->random()->uuid,
                'vehicle_uuid' => $vehicle->uuid,
            ]);
        }
    }
}
