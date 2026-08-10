<?php

namespace App\Services;

use App\Mail\NewClaimMail;
use App\Models\Claim;
use App\Models\Food;
use App\Models\User;
use App\Notifications\NewClaimNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ClaimService
{
    public function claimFood(User $user, Food $food): Claim
    {
        return DB::transaction(function () use ($user, $food) {
            $lockedFood = Food::where('id', $food->id)->lockForUpdate()->first();

            if ($lockedFood->status !== 'available' || $lockedFood->quantity < 1) {
                throw ValidationException::withMessages([
                    'food' => 'Maaf, makanan ini sudah tidak tersedia.',
                ]);
            }

            $alreadyClaimed = Claim::where('food_id', $food->id)
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if ($alreadyClaimed) {
                throw ValidationException::withMessages([
                    'food' => 'Anda sudah mengklaim makanan ini sebelumnya.',
                ]);
            }

            $lockedFood->decrement('quantity');

            if ($lockedFood->quantity <= 0) {
                $lockedFood->update(['status' => 'claimed']);
            }

            $claim = Claim::create([
                'food_id' => $food->id,
                'user_id' => $user->id,
                'status' => 'pending',
            ]);

            $restaurantOwner = $lockedFood->restaurant->user;

            $restaurantOwner->notify(new NewClaimNotification($claim));

            Mail::to($restaurantOwner->email)->queue(new NewClaimMail($claim));

            return $claim;
        });
    }
}