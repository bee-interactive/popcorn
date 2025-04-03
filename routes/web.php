<?php

use App\Http\Controllers\User\UserController;
use App\Livewire\Item\ViewedItems;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Tmdb;
use App\Livewire\Trending\TrendingItems;
use App\Livewire\Users\Feed;
use App\Livewire\Wishlist\ListIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware(['auth'])->group(function (): void {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('trending', TrendingItems::class)->name('trending.index');

    Route::get('viewed', ViewedItems::class)->name('viewed.index');

    Route::get('feed', Feed::class)->name('feed.index');

    Route::redirect('settings', 'settings/profile');

    Route::get('my-lists/{uuid}', ListIndex::class)->name('wishlists.show');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/the-movie-database-token', Tmdb::class)->name('settings.tmdb');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::prefix('/@{username}')->group(function () {
    Route::get('/', UserController::class)->name('profile.show');
});

require __DIR__.'/auth.php';
