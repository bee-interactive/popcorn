<?php

namespace App\Http\Controllers\Api\Feed;

use App\Http\Resources\ItemResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class FeedController
{
    public function __invoke()
    {
        $dates['data'] = User::public()->with(['items' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->whereHas('items')
            ->get()
            ->flatMap(function ($user) {
                return $user->items->map(function ($item) use ($user) {
                    return [
                        'date' => $item->created_at->format('Y-m-d'),
                        'user' => UserResource::make($user),
                        'item' => ItemResource::make($item),
                    ];
                });
            })
            ->groupBy('date')
            ->map(function ($group) {
                return [
                    'date' => $group->first()['date'],
                    'users' => $group->groupBy('user.id')->map(function ($userItems) {
                        return [
                            'user' => $userItems->first()['user'],
                        ];
                    })->values(),
                ];
            })
            ->values()
            ->toArray();

        return $dates;
    }
}
