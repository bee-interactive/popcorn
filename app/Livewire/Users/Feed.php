<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Feed extends Component
{
    public $users;

    public function mount()
    {
        $this->users = $this->getUsers();
    }

    public function getUsers()
    {
        $this->users = User::with(['items' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->whereHas('items')
            ->get()
            ->map(function ($user) {
                return [
                    'user' => $user->only(['id', 'name', 'username']),
                    'elements' => $user->items->groupBy(fn ($item) => $item->created_at->format('Y-m-d'))
                        ->map(fn ($items) => $items->map(fn ($item) => $item->only(['id', 'name', 'backdrop_path', 'poster_path', 'created_at']))), // Convert to array
                ];
            })
            ->toArray();

        return $this->users;
    }
}
