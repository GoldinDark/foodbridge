<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('user')
            ->where('verification_status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.restaurants.index', [
            'restaurants' => $restaurants,
        ]);
    }

    public function verify(Request $request, Restaurant $restaurant)
    {
        $restaurant->update([
            'verification_status' => 'verified',
            'verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        return back()->with('success', "Restoran {$restaurant->business_name} berhasil diverifikasi.");
    }

    public function reject(Request $request, Restaurant $restaurant)
    {
        $restaurant->update([
            'verification_status' => 'rejected',
            'verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        return back()->with('success', "Restoran {$restaurant->business_name} ditolak.");
    }

    public function viewDocument(Restaurant $restaurant)
    {
        if (! $restaurant->business_document || ! Storage::disk('local')->exists($restaurant->business_document)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        return Storage::disk('local')->response($restaurant->business_document);
    }
}