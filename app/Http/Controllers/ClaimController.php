<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Services\ClaimService;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function __construct(
        protected ClaimService $claimService
    ) {}

    public function store(Request $request, Food $food)
    {
        $this->claimService->claimFood($request->user(), $food);

        return redirect()
            ->route('foods.show', $food)
            ->with('success', 'Klaim berhasil dikirim! Menunggu konfirmasi restoran.');
    }
}