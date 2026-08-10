<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('home_stats', now()->addMinutes(10), function () {
            return [
                'total_foods_saved' => Claim::where('status', 'completed')->count(),
                'total_restaurants' => Restaurant::where('verification_status', 'verified')->count(),
                'total_available_foods' => Food::where('status', 'available')->count(),
            ];
        });

        $latestFoods = Food::with(['restaurant', 'category'])
            ->where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        return view('home', [
            'stats' => $stats,
            'latestFoods' => $latestFoods,
        ]);
    }
}