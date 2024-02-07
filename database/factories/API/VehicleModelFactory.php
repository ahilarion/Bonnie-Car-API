<?php

namespace Database\Factories\API;

use App\Models\API\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\API\VehicleModel>
 */
class VehicleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = VehicleType::all();

        return [
            'name' => $this->faker->word,
            'display_name' => $this->faker->word,
            'estimated_price' => $this->faker->randomFloat(2, 1000, 100000),
            'gearbox' => $this->faker->randomElement(['manual', 'automatic']),
            'fuel_type' => $this->faker->randomElement(['gasoline', 'petrol', 'diesel', 'propane', 'compressed natural gas', 'liquefied petroleum gas', 'ethanol', 'methanol', 'biodiesel', 'hydrogen']),
            'horse_power' => $this->faker->randomNumber(3),
            'consumption' => $this->faker->randomFloat(2, 3, 20),
            'release_year' => $this->faker->dateTimeBetween('-32 years', 'now')->format('Y'),
            'vehicle_type_id' => $types->random()->id,
        ];
    }
}
