<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Feed\FeedController;
use App\Http\Controllers\Api\Item\ItemController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function (): void {
    Route::resource('wishlists', WishlistController::class);

    Route::resource('items', ItemController::class);

    Route::post('users/me', [UserController::class, 'me'])->name('users.me');
    Route::post('users/password', [UserController::class, 'password'])->name('users.password');
    Route::post('users/tmdb-token', [UserController::class, 'tmdb'])->name('users.tmdb');
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('feed', FeedController::class)->name('api.feed.index');
});

Route::resource('users', UserController::class)->only(['show']);
