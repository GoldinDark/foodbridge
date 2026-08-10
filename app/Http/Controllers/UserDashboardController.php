<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $claims = $user->claims()
            ->with(['food.restaurant'])
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_claims' => $user->claims()->count(),
            'completed_claims' => $user->claims()->where('status', 'completed')->count(),
            'pending_claims' => $user->claims()->whereIn('status', ['pending', 'confirmed'])->count(),
        ];

        $badges = $user->badges()->get();

        return view('user.dashboard', [
            'claims' => $claims,
            'stats' => $stats,
            'badges' => $badges,
        ]);
    }
}