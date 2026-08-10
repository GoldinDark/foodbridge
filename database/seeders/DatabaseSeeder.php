<?php

namespace Database\Seeders;

use App\Models\Claim;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        RoleSeeder::class,
        PermissionSeeder::class,
        UserSeeder::class,
        CategorySeeder::class,
        RestaurantSeeder::class,
        FoodSeeder::class,
        BadgeSeeder::class,
    ]);

        // Buat review HANYA untuk claim yang statusnya sudah completed
        Claim::where('status', 'completed')->get()->each(function ($claim) {
            \App\Models\Review::factory()->create([
                'claim_id' => $claim->id,
            ]);
        });
    }
}