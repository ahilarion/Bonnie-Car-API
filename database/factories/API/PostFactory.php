<?php

namespace Database\Factories\API;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text(255),
            'images' => json_encode($this->faker->randomElements(['image1', 'image2', 'image3', 'image4', 'image5'], 3)),
            'price' => $this->faker->randomNumber(5),
            'kilometer' => $this->faker->randomNumber(5),
            'reduction' => $this->faker->randomFloat(2, 0, 30),
            'status' => $this->faker->randomElement(['pending', 'available', 'processed', 'cancelled', 'sold']),
        ];
    }
}
