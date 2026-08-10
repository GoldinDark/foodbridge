<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->randomElement([
                'Roti Sisa Produksi',
                'Nasi Kotak Sisa Acara',
                'Kue Ulang Tahun Sisa',
                'Buah Segar Berlebih',
                'Sandwich Sisa Display',
                'Donat Sisa Harian',
            ]),
            'description' => $this->faker->sentence(10),
            'quantity' => $this->faker->numberBetween(1, 20),
            'pickup_deadline' => now()->addHours($this->faker->numberBetween(1, 12)),
            'status' => 'available',
        ];
    }
}