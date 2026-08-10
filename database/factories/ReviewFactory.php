<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'rating' => $this->faker->numberBetween(3, 5),
            'comment' => $this->faker->optional(0.7)->sentence(8),
        ];
    }
}