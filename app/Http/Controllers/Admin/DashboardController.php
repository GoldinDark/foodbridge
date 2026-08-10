<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::role('user')->count(),
            'total_restaurants' => Restaurant::count(),
            'pending_restaurants' => Restaurant::where('verification_status', 'pending')->count(),
            'total_foods' => Food::count(),
            'total_claims' => Claim::count(),
            'completed_claims' => Claim::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', [
            'stats' => $stats,
        ]);
    }
}