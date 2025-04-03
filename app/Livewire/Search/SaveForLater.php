<?php

namespace App\Livewire\Search;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class SaveForLater extends ModalComponent
{
    public $result;

    public $wishlist;

    public string $note = '';

    public function mount($result): void
    {
        $this->result = $result;
    }

    public function save(): void
    {
        $wishlist = Auth::user()->wishlists()->find($this->wishlist);

        $wishlist->items()->create([
            'name' => ($this->result['title'] ?? $this->result['name']),
            'synopsis' => ($this->result['overview'] ?? null),
            'backdrop_path' => ($this->result['backdrop_path'] ?? null),
            'poster_path' => ($this->result['poster_path'] ?? $this->result['profile_path'] ?? null),
            'release_date' => (! empty($this->result['release_date']) ? $this->result['release_date'] : null),
            'media_type' => $this->result['media_type'],
            'note' => $this->note,
        ]);

        $this->dispatch('data-updated');

        Flux::toast(
            text: __('The item was saved successfully'),
            variant: 'success',
        );

        $this->closeModal();
    }
}
