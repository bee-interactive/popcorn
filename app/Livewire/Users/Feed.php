<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Feed extends Component
{
    public $dates;

    public function mount()
    {
        $this->dates = $this->getDates();
    }

    public function getDates()
    {
        $this->dates = User::public()->with(['items' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->whereHas('items')
            ->get()
            ->flatMap(function ($user) {
                return $user->items->map(function ($item) use ($user) {
                    return [
                        'date' => $item->created_at->format('Y-m-d'),
                        'user' => $user,
                        'item' => $item->only(['id', 'name', 'backdrop_path', 'poster_path', 'created_at']),
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
                            'items' => $userItems->pluck('item'),
                        ];
                    })->values(),
                ];
            })
            ->values()
            ->toArray();

        return $this->dates;
    }
}
