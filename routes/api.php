<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Item\ItemController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [LoginController::class, 'login']);

Route::resource('users', UserController::class);

Route::middleware(['auth:sanctum'])->group(function (): void {
    Route::resource('wishlists', WishlistController::class);

    Route::resource('items', ItemController::class);
});
