<?php

namespace App\Http\Controllers\Api\Wishlist;

use App\Http\Requests\Api\Wishlist\StoreWishlistRequest;
use App\Http\Requests\Api\Wishlist\UpdateWishlistRequest;
use App\Http\Resources\WishlistResource;
use Exception;

class WishlistController
{
    public function index()
    {
        return WishlistResource::collection(auth()->user()->wishlists()->get());
    }

    public function show(string $uuid)
    {
        return new WishlistResource(auth()->user()->wishlists()->where('uuid', $uuid)->firstOrFail());
    }

    public function store(StoreWishlistRequest $request)
    {
        return new WishlistResource($request->user()->wishlists()->create([
            'name' => $request->validated('data.name'),
            'is_favorite' => $request->validated('data.is_favorite'),
        ]));
    }

    public function update(UpdateWishlistRequest $request, string $uuid)
    {
        $wishlist = $request->user()->wishlists()->where('uuid', $uuid)->firstOrFail();

        $wishlist->update([
            'name' => $request->validated('data.name'),
            'is_favorite' => $request->validated('data.is_favorite'),
        ]);

        return new WishlistResource($wishlist);
    }

    public function destroy(string $uuid)
    {
        try {
            $wishlist = auth()->user()->wishlists()->where('uuid', $uuid)->firstOrFail();

            $wishlist->items()->each(function ($item) {
                $item->delete();
            });

            $wishlist->delete();

            return response()->json(['message' => 'Wishlist deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Wishlist not found'], 404);
        }
    }
}
