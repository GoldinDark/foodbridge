<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Requests\Food\StoreFoodRequest;
use Illuminate\Support\Facades\Storage;


class FoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Food::with(['restaurant', 'category'])
            ->where('status', 'available');

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sort') && $request->sort === 'deadline') {
            $query->orderBy('pickup_deadline', 'asc');
        } else {
            $query->latest();
        }

        $foods = $query->paginate(9)->withQueryString();

        return view('foods.index', [
            'foods' => $foods,
            'categories' => \App\Models\Category::all(),
        ]);
    }


    public function show(Food $food)
    {
        $food->load(['restaurant', 'category']);

        $avgRating = \App\Models\Review::whereHas('claim.food', function ($query) use ($food) {
                $query->where('restaurant_id', $food->restaurant_id);
            })
            ->avg('rating');

        return view('foods.show', [
            'food' => $food,
            'avgRating' => round($avgRating ?? 0, 1),
        ]);
    }

    public function store(StoreFoodRequest $request)
    {
        $validated = $request->validated();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('foods', 'public');
        }

        $restaurant = $request->user()->restaurant;

        $restaurant->foods()->create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'photo' => $photoPath,
            'quantity' => $validated['quantity'],
            'pickup_deadline' => $validated['pickup_deadline'],
            'status' => 'available',
        ]);

        return redirect()->route('restaurant.dashboard')->with('success', 'Makanan berhasil diunggah!');
    }
}