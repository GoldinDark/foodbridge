<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Penyelamat Pertama',
                'description' => 'Berhasil menyelesaikan klaim makanan pertama Anda.',
            ],
            [
                'name' => 'Pahlawan Pangan',
                'description' => 'Berhasil menyelesaikan 10 klaim makanan.',
            ],
            [
                'name' => 'Bintang Lima',
                'description' => 'Memberikan rating 5 bintang untuk pertama kalinya.',
            ],
            [
                'name' => 'Donatur Setia',
                'description' => 'Restoran yang telah membagikan 50 porsi makanan.',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}