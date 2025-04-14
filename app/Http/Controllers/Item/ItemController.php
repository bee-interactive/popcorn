<?php

namespace App\Http\Controllers\Item;

use Illuminate\View\View;

class ItemController
{
    public function __invoke(string $uuid): View
    {
        return view('items.show', [
            'item' => auth()->user()->items()->where('items.uuid', $uuid)->firstOrFail(),
        ]);
    }
}
