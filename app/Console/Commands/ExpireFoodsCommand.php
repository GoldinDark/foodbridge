<?php

namespace App\Console\Commands;

use App\Models\Food;
use Illuminate\Console\Command;

class ExpireFoodsCommand extends Command
{
    protected $signature = 'foods:expire';

    protected $description = 'Mengubah status makanan yang sudah lewat batas waktu ambil menjadi expired';

    public function handle(): void
    {
        $expiredCount = Food::where('status', 'available')
            ->where('pickup_deadline', '<', now())
            ->update(['status' => 'expired']);

        $this->info("Berhasil! {$expiredCount} makanan diubah menjadi expired.");
    }
}