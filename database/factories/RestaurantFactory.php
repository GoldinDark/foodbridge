<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'business_name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'verification_status' => 'verified',
        ];
    }
}