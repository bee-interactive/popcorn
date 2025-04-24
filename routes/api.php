<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Feed\FeedController;
use App\Http\Controllers\Api\Item\ItemController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Avatar\AvatarController;
use App\Http\Controllers\Api\Feed\UserFeedController;
use App\Http\Controllers\Api\Wishlist\WishlistController;

Route::post('auth/login', [LoginController::class, 'login'])->name('api.login');
Route::post('auth/register', [RegisterController::class, 'register'])->name('api.register');

Route::middleware(['auth:sanctum'])->group(function (): void {
    Route::resource('wishlists', WishlistController::class);

    Route::resource('items', ItemController::class);

    Route::post('users/me', [UserController::class, 'me'])->name('users.me');
    Route::post('users/password', [UserController::class, 'password'])->name('users.password');
    Route::post('users/tmdb-token', [UserController::class, 'tmdb'])->name('users.tmdb');
    Route::post('users/{uuid}/avatar', [AvatarController::class, 'store'])->name('avatar.store');
    Route::post('users/{uuid}/avatar/delete', [AvatarController::class, 'destroy'])->name('avatar.delete');
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('feed', FeedController::class)->name('api.feed.index');

    Route::get('users-feed', UserFeedController::class)->name('api.user.feed.index');
});

Route::resource('users', UserController::class)->only(['show']);
