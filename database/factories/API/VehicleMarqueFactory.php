<?php

namespace Database\Factories\API;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\API\VehicleMarque>
 */
class VehicleMarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marque = $this->faker->company;

        return [
            'name' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', strtolower($marque))),
            'display_name' => ucfirst($marque)
        ];
    }
}
