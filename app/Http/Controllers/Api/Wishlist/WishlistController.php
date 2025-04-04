<?php

namespace App\Http\Controllers\Api\Wishlist;

use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;

class WishlistController
{
    public function index()
    {
        return WishlistResource::collection(Wishlist::all());
    }

    public function show(string $uuid)
    {
        return new WishlistResource(Wishlist::where('uuid', $uuid)->firstOrFail());
    }
}
