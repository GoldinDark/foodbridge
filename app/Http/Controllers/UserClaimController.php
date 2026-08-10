<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class UserClaimController extends Controller
{
    public function show(Request $request, Claim $claim)
    {
        if ($claim->user_id !== $request->user()->id) {
            abort(403);
        }

        $claim->load(['food.restaurant']);

        return view('user.claims.show', [
            'claim' => $claim,
        ]);
    }
}