<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Robot>
 */
class RobotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->id,
            'name' => $this->faker->name,
            'media' => $this->faker->url,
            'status' => $this->faker->randomElement(['Departed', 'Arrived', 'On route']),
        ];
    }
}
