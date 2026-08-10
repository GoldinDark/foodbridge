<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class RestaurantDashboardController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = $request->user()->restaurant;

        $notifications = $request->user()->notifications()->latest()->take(10)->get();

        $pendingClaims = $this->getPendingClaims($restaurant->id);

        return view('restaurant.dashboard', [
            'notifications' => $notifications,
            'pendingClaimsJson' => $pendingClaims,
            'unreadCount' => $request->user()->unreadNotifications()->count(),
        ]);
    }

    public function poll(Request $request)
    {
        $restaurant = $request->user()->restaurant;

        return response()->json([
            'pending_claims' => $this->getPendingClaims($restaurant->id),
            'unread_count' => $request->user()->unreadNotifications()->count(),
        ]);
    }

    protected function getPendingClaims(int $restaurantId): array
    {
        $claims = Claim::whereHas('food', function ($query) use ($restaurantId) {
                $query->where('restaurant_id', $restaurantId);
            })
            ->where('status', 'pending')
            ->with(['user', 'food'])
            ->latest()
            ->get();

        $result = [];

        foreach ($claims as $claim) {
            $result[] = [
                'id' => $claim->id,
                'food_name' => $claim->food->name,
                'user_name' => $claim->user->name,
                'created_at' => $claim->created_at->diffForHumans(),
                'accept_url' => route('restaurant.claims.accept', $claim),
                'reject_url' => route('restaurant.claims.reject', $claim),
            ];
        }

        return $result;
    }
}