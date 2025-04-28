<?php

namespace App\Http\Controllers\Api\Feed;

use App\Http\Resources\ItemResource;
use App\Http\Resources\UserResource;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserFeedController
{
    public function __invoke()
    {
        $items['data'] = DB::table('item_wishlist')
            ->join('wishlists', 'item_wishlist.wishlist_id', '=', 'wishlists.id')
            ->join('users', 'wishlists.user_id', '=', 'users.id')
            ->where('users.public_profile', 1)
            ->select(
                DB::raw('DATE(item_wishlist.created_at) as date'),
                'wishlists.user_id',
                'item_wishlist.item_id'
            )
            ->get()
            ->groupBy('date')
            ->map(function ($entriesByDate, $date) {
                $usersGrouped = collect($entriesByDate)->groupBy('user_id')->map(function ($entriesByUser, $userId) {
                    $itemIds = $entriesByUser->pluck('item_id')->unique();

                    $user = User::find($userId);
                    $items = Item::whereIn('id', $itemIds)->get();

                    return [
                        'user' => UserResource::make($user),
                        'items' => ItemResource::collection($items),
                    ];
                });

                return [
                    'date' => $date,
                    'users' => $usersGrouped->values(),
                ];
            })->sortKeysDesc()->values();

        return $items;
    }
}
