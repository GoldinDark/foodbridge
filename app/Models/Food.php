<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'restaurant_id',
    'category_id',
    'name',
    'description',
    'photo',
    'quantity',
    'pickup_deadline',
    'status',
])]
class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected function casts(): array
    {
        return [
            'pickup_deadline' => 'datetime',
        ];
    }

    public function restaurant()
    {
           return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}