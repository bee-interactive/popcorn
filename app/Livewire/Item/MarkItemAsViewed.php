<?php

namespace App\Livewire\Item;

use App\Livewire\Item\Item as ItemComponent;
use App\Models\Item;
use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class MarkItemAsViewed extends ModalComponent
{
    public Item $item;

    public ?string $note = null;

    public function mount(Item $item): void
    {
        $this->item = $item;

        $this->note = $item->note;
    }

    public function save()
    {
        $this->item->update([
            'note' => $this->note,
            'watched' => true,
        ]);

        $this->dispatch('mark-as-viewed')->to(ItemComponent::class);

        Flux::toast(
            text: __('The element has been marked as viewed successfully'),
            variant: 'success',
        );

        $this->closeModal();
    }
}
