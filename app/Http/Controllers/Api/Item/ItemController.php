<?php

namespace App\Http\Controllers\Api\Item;

use App\Http\Requests\Api\Item\StoreItemRequest;
use App\Http\Requests\Api\Item\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use Exception;

class ItemController
{
    public function index()
    {
        $query = auth()->user()->items();

        if (request()->has('watched')) {
            $query->where('watched', filter_var(request()->get('watched'), FILTER_VALIDATE_BOOLEAN));
        }

        return ItemResource::collection($query->get());
    }

    public function show(string $uuid)
    {
        return new ItemResource(auth()->user()->items()->where('items.uuid', $uuid)->firstOrFail());
    }

    public function store(StoreItemRequest $request)
    {
        $wishlist = $request->user()->wishlists()->where('uuid', $request->validated('data.wishlist_uuid'))->firstOrFail();

        $item = $request->user()->items()->create([
            'media_type' => $request->validated('data.media_type'),
            'name' => $request->validated('data.name'),
            'synpsis' => $request->validated('data.synpsis'),
            'backdrop_path' => $request->validated('data.backdrop_path'),
            'poster_path' => $request->validated('data.poster_path'),
            'release_date' => $request->validated('data.release_date'),
            'note' => $request->validated('data.note'),
            'watched' => $request->validated('data.watched'),
        ]);

        $wishlist->items()->attach($item->id);

        return new ItemResource($item);
    }

    public function update(UpdateItemRequest $request, string $uuid)
    {
        $item = $request->user()->items()->where('items.uuid', $uuid)->firstOrFail();

        $item->update([
            'media_type' => $request->validated('data.media_type'),
            'name' => $request->validated('data.name'),
            'synpsis' => $request->validated('data.synpsis'),
            'backdrop_path' => $request->validated('data.backdrop_path'),
            'poster_path' => $request->validated('data.poster_path'),
            'release_date' => $request->validated('data.release_date'),
            'note' => $request->validated('data.note'),
            'watched' => $request->validated('data.watched'),
        ]);

        return new ItemResource($item);
    }

    public function destroy(string $uuid)
    {
        try {
            $item = auth()->user()->items()->where('items.uuid', $uuid)->firstOrFail();
            $item->delete();

            return response()->json(['message' => 'Item deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    }
}
