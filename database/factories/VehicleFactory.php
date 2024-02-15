<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'constructor' => $this->faker->name,
            'model' => $this->faker->name,
            'original_price' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(['car', 'motorcycle']),
            'is_two_wheeled' => $this->faker->boolean,
            'energy_source' => $this->faker->randomElement(['gasoline', 'alcohol', 'flex', 'diesel', 'electric']),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'cylinder_capacity' => $this->faker->randomFloat(2, 0, 1000),
            'power' => $this->faker->randomFloat(2, 0, 1000),
            'torque' => $this->faker->randomFloat(2, 0, 1000),
            'year_of_manufacture' => $this->faker->year,
            'production_year' => $this->faker->year,
            'circulation_date' => $this->faker->date,
            'technical_revision' => $this->faker->date,
            'number_of_owners' => $this->faker->numberBetween(0, 10),
            'kilometers' => $this->faker->randomFloat(2, 0, 1000),
            'color' => $this->faker->colorName,
            'number_of_doors' => $this->faker->numberBetween(0, 10),
            'seats' => $this->faker->numberBetween(0, 10),
            'vehicle_length' => $this->faker->randomFloat(2, 0, 1000),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'description' => $this->faker->paragraph,
        ];
    }
}
