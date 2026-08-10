<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimManagementController extends Controller
{
    public function accept(Request $request, Claim $claim)
    {
        $this->authorizeClaim($request, $claim);

        $claim->update([
            'status' => 'confirmed',
            'qr_code' => \Illuminate\Support\Str::uuid(),
        ]);

        return back()->with('success', 'Klaim berhasil dikonfirmasi.');
    }

    public function reject(Request $request, Claim $claim)
    {
        $this->authorizeClaim($request, $claim);

        $claim->update(['status' => 'rejected']);

        $claim->food()->increment('quantity');
        $claim->food()->update(['status' => 'available']);

        return back()->with('success', 'Klaim ditolak, stok dikembalikan.');
    }

    protected function authorizeClaim(Request $request, Claim $claim): void
    {
        if ($claim->food->restaurant->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak mengelola klaim ini.');
        }
    }
}