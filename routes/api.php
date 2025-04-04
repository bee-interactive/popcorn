<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function (): void {
    Route::resource('wishlists', WishlistController::class);
});
