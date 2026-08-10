<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topUsers = User::role('user')
            ->withCount(['claims as claims_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->whereHas('claims', function ($query) {
                $query->where('status', 'completed');
            })
            ->orderByDesc('claims_count')
            ->take(20)
            ->get();

        return view('leaderboard', [
            'topUsers' => $topUsers,
        ]);
    }
} 