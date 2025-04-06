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
        return ItemResource::collection(auth()->user()->items()->get());
    }

    public function show(string $uuid)
    {
        return new ItemResource(auth()->user()->items()->where('items.uuid', $uuid)->firstOrFail());
    }

    public function store(StoreItemRequest $request)
    {
        return new ItemResource($request->user()->items()->create([
            'media_type' => $request->validated('data.media_type'),
            'name' => $request->validated('data.name'),
            'synpsis' => $request->validated('data.synpsis'),
            'backdrop_path' => $request->validated('data.backdrop_path'),
            'poster_path' => $request->validated('data.poster_path'),
            'release_date' => $request->validated('data.release_date'),
            'note' => $request->validated('data.note'),
            'watched' => $request->validated('data.watched'),
        ]));
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
