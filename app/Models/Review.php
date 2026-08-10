<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['claim_id', 'rating', 'comment', 'restaurant_reply', 'replied_at'])]
class Review extends Model
{
    use HasFactory;

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}