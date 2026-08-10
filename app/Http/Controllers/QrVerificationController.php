<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Services\BadgeService;
use Illuminate\Http\Request;

class QrVerificationController extends Controller
{
    public function __construct(
        protected BadgeService $badgeService
    ) {}

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => ['required', 'string'],
        ]);

        $claim = Claim::where('qr_code', $validated['qr_code'])->first();

        if (! $claim) {
            return back()->withErrors(['qr_code' => 'QR Code tidak valid.']);
        }

        if ($claim->food->restaurant->user_id !== $request->user()->id) {
            return back()->withErrors(['qr_code' => 'QR Code ini bukan milik restoran Anda.']);
        }

        if ($claim->status !== 'confirmed') {
            return back()->withErrors(['qr_code' => 'Klaim ini sudah pernah diselesaikan atau tidak valid lagi.']);
        }

        $claim->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $this->badgeService->checkAndAwardBadges($claim->user);

        return back()->with('success', "Berhasil! Klaim untuk \"{$claim->food->name}\" telah diselesaikan.");
    }
}