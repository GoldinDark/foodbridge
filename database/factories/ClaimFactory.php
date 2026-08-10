<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClaimFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'confirmed', 'rejected', 'completed']);

        return [
            'food_id' => Food::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'qr_code' => in_array($status, ['confirmed', 'completed'])
                ? Str::uuid()
                : null,
            'status' => $status,
            'rejection_reason' => $status === 'rejected'
                ? 'Makanan sudah tidak layak konsumsi saat dicek ulang.'
                : null,
            'completed_at' => $status === 'completed'
                ? now()
                : null,
        ];
    }
}