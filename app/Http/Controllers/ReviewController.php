<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Services\BadgeService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        protected BadgeService $badgeService
    ) {}

    public function store(Request $request, Claim $claim)
    {
        if ($claim->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($claim->status !== 'completed') {
            return back()->withErrors(['review' => 'Hanya klaim yang sudah selesai yang bisa direview.']);
        }

        if ($claim->review()->exists()) {
            return back()->withErrors(['review' => 'Anda sudah memberikan review untuk klaim ini.']);
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        $claim->review()->create($validated);

        $this->badgeService->checkAndAwardBadges($request->user());

        return back()->with('success', 'Terima kasih atas review Anda!');
    }
}