<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Food $food)
    {
        $user = $request->user();

        if ($user->favoriteFoods()->where('food_id', $food->id)->exists()) {
            $user->favoriteFoods()->detach($food->id);
            $message = 'Dihapus dari favorit.';
        } else {
            $user->favoriteFoods()->attach($food->id);
            $message = 'Ditambahkan ke favorit.';
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        return back()->with('success', $message);
    }

    public function index(Request $request)
    {
        $favorites = $request->user()->favoriteFoods()
            ->with(['restaurant', 'category'])
            ->paginate(9);

        return view('user.favorites', [
            'favorites' => $favorites,
        ]);
    }
}