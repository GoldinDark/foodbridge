<?php

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use App\Services\ClaimService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

uses(RefreshDatabase::class);

it('berhasil mengklaim makanan yang tersedia', function () {
    $restaurant = Restaurant::factory()->create();
    $category = Category::factory()->create();
    $food = Food::factory()->create([
        'restaurant_id' => $restaurant->id,
        'category_id' => $category->id,
        'quantity' => 5,
        'status' => 'available',
    ]);
    $user = User::factory()->create();

    $claim = app(ClaimService::class)->claimFood($user, $food);

    expect($claim->status)->toBe('pending');
    expect($claim->user_id)->toBe($user->id);
    expect($food->fresh()->quantity)->toBe(4);
});

it('menolak klaim jika makanan sudah habis', function () {
    $restaurant = Restaurant::factory()->create();
    $category = Category::factory()->create();
    $food = Food::factory()->create([
        'restaurant_id' => $restaurant->id,
        'category_id' => $category->id,
        'quantity' => 0,
        'status' => 'claimed',
    ]);
    $user = User::factory()->create();

    app(ClaimService::class)->claimFood($user, $food);
})->throws(ValidationException::class);

it('menolak klaim ganda untuk makanan yang sama', function () {
    $restaurant = Restaurant::factory()->create();
    $category = Category::factory()->create();
    $food = Food::factory()->create([
        'restaurant_id' => $restaurant->id,
        'category_id' => $category->id,
        'quantity' => 10,
        'status' => 'available',
    ]);
    $user = User::factory()->create();

    app(ClaimService::class)->claimFood($user, $food);

    app(ClaimService::class)->claimFood($user, $food);
})->throws(ValidationException::class);