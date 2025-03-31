<?php

namespace App\Livewire\Wishlist;

use Livewire\Attributes\On;
use Livewire\Component;

class UserWishlists extends Component
{
    #[On('data-updated')]
    public function render()
    {
        return view('livewire.wishlist.user-wishlists');
    }
}
