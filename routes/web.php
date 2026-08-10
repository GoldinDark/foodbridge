<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ClaimManagementController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RestaurantDashboardController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserClaimController;
use App\Http\Controllers\QrVerificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewReplyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;


/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses SIAPA SAJA)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
Route::get('/foods/{food}', [FoodController::class, 'show'])->name('foods.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/restaurants', [PageController::class, 'restaurants'])->name('restaurants.index');
Route::get('/articles', [PageController::class, 'articles'])->name('articles.public.index');
Route::get('/articles/{article:slug}', [PageController::class, 'articleShow'])->name('articles.public.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:3,1');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

/*
|--------------------------------------------------------------------------
| Routes yang HANYA untuk yang SUDAH login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/foods/{food}/claim', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/claims/{claim}', [UserClaimController::class, 'show'])->name('claims.show');
    Route::post('/claims/{claim}/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/foods/{food}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/restaurants', [AdminRestaurantController::class, 'index'])->name('restaurants.index');
        Route::get('/restaurants/{restaurant}/document', [AdminRestaurantController::class, 'viewDocument'])->name('restaurants.document');
        Route::post('/restaurants/{restaurant}/verify', [AdminRestaurantController::class, 'verify'])->name('restaurants.verify');
        Route::post('/restaurants/{restaurant}/reject', [AdminRestaurantController::class, 'reject'])->name('restaurants.reject');
        Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    });

/*
|--------------------------------------------------------------------------
| Restaurant Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:restaurant'])
    ->prefix('restaurant')
    ->name('restaurant.')
    ->group(function () {
        Route::get('/dashboard', [RestaurantDashboardController::class, 'index'])->name('dashboard');
        Route::get('/poll', [RestaurantDashboardController::class, 'poll'])->name('poll');
        Route::post('/foods', [FoodController::class, 'store'])->name('foods.store');
        Route::post('/claims/{claim}/accept', [ClaimManagementController::class, 'accept'])->name('claims.accept');
        Route::post('/claims/{claim}/reject', [ClaimManagementController::class, 'reject'])->name('claims.reject');
        Route::post('/verify-qr', [QrVerificationController::class, 'verify'])->name('verify-qr');
        Route::get('/reviews', [ReviewReplyController::class, 'index'])->name('reviews.index');
        Route::post('/reviews/{review}/reply', [ReviewReplyController::class, 'reply'])->name('reviews.reply');
    });

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    });