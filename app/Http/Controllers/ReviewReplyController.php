<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewReplyController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = $request->user()->restaurant;

        $reviews = Review::whereHas('claim.food', function ($query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->id);
            })
            ->with(['claim.food', 'claim.user'])
            ->latest()
            ->paginate(10);

        return view('restaurant.reviews', [
            'reviews' => $reviews,
        ]);
    }

    public function reply(Request $request, Review $review)
    {
        if ($review->claim->food->restaurant->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'restaurant_reply' => ['required', 'string', 'max:500'],
        ]);

        $review->update([
            'restaurant_reply' => $validated['restaurant_reply'],
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}