<?php

namespace App\Livewire\Wishlist;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateWishlist extends ModalComponent
{
    public $name;

    public $is_favorite;

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $wishlist = Auth::user()->wishlists()->create([
            'name' => $this->name,
            'is_favorite' => $this->is_favorite ?? false,
            'order' => Auth::user()->wishlists()->max('order') + 1,
        ]);

        $this->name = null;
        $this->is_favorite = false;

        $this->dispatch('data-updated', $wishlist);

        Flux::toast(
            text: __('Wishlist created successfully'),
            variant: 'success',
        );

        $this->closeModal();
    }
}
