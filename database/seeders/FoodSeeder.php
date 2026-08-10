<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $rotiEnak = Restaurant::where('business_name', 'Roti Enak Bakery')->first();
        $warungBuSiti = Restaurant::where('business_name', 'Warung Bu Siti')->first();

        $rotiPastry = Category::where('slug', 'roti-pastry')->first();
        $nasiLauk = Category::where('slug', 'nasi-lauk')->first();
        $kueDessert = Category::where('slug', 'kue-dessert')->first();

        Food::create([
            'restaurant_id' => $rotiEnak->id,
            'category_id' => $rotiPastry->id,
            'name' => 'Roti Tawar Gandum',
            'description' => 'Roti tawar gandum sisa produksi hari ini, masih segar dan layak konsumsi.',
            'quantity' => 8,
            'pickup_deadline' => now()->addHours(4),
            'status' => 'available',
        ]);

        Food::create([
            'restaurant_id' => $rotiEnak->id,
            'category_id' => $kueDessert->id,
            'name' => 'Croissant Coklat',
            'description' => 'Croissant coklat lebih dari stok harian, kondisi masih baik.',
            'quantity' => 5,
            'pickup_deadline' => now()->addHours(3),
            'status' => 'available',
        ]);

        Food::create([
            'restaurant_id' => $warungBuSiti->id,
            'category_id' => $nasiLauk->id,
            'name' => 'Nasi Ayam Geprek',
            'description' => 'Nasi ayam geprek sisa menu hari ini, sudah kami kemas rapi.',
            'quantity' => 10,
            'pickup_deadline' => now()->addHours(2),
            'status' => 'available',
        ]);

         \App\Models\Food::factory()->count(20)->create();
         \App\Models\Claim::factory()->count(15)->create();
    }
}