<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $rotiEnak = User::where('email', 'rotienak@foodbridge.test')->first();
        $warungBuSiti = User::where('email', 'warungbusiti@foodbridge.test')->first();
        $admin = User::where('email', 'admin@foodbridge.test')->first();

        Restaurant::create([
            'user_id' => $rotiEnak->id,
            'business_name' => 'Roti Enak Bakery',
            'business_document' => 'documents/dummy-nib-1.pdf',
            'address' => 'Jl. Merdeka No. 10, Bandung',
            'latitude' => -6.9147,
            'longitude' => 107.6098,
            'verification_status' => 'verified',
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);

        Restaurant::create([
            'user_id' => $warungBuSiti->id,
            'business_name' => 'Warung Bu Siti',
            'business_document' => 'documents/dummy-nib-2.pdf',
            'address' => 'Jl. Asia Afrika No. 25, Bandung',
            'latitude' => -6.9218,
            'longitude' => 107.6070,
            'verification_status' => 'pending',
        ]);
    }
}