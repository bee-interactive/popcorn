<?php

namespace App\Livewire\List;

use App\Models\Wishlist;
use Livewire\Component;

class ListIndex extends Component
{
    public Wishlist $wishlist;

    public function mount(string $uuid): void
    {
        $this->wishlist = Wishlist::where('uuid', $uuid)->firstOrFail();
    }
}
