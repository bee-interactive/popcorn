<?php

namespace App\Livewire\List;

use App\Models\Item as ItemModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Item extends Component
{
    public ItemModel $item;

    public function mount(ItemModel $item): void
    {
        $this->item = $item;
    }

    #[On('data-updated')]
    public function render()
    {
        return view('livewire.list.item');
    }
}
