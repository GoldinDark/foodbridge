<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin FoodBridge',
            'email' => 'admin@foodbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $budi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@foodbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $budi->assignRole('user');

        $siti = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@foodbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $siti->assignRole('user');

        $rotiEnak = User::create([
            'name' => 'Roti Enak Bakery',
            'email' => 'rotienak@foodbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $rotiEnak->assignRole('restaurant');

        $warungBuSiti = User::create([
            'name' => 'Warung Bu Siti',
            'email' => 'warungbusiti@foodbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $warungBuSiti->assignRole('restaurant');
    }
}