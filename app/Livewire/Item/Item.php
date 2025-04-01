<?php

namespace App\Livewire\Item;

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

    #[On('mark-as-viewed')]
    public function render()
    {
        return view('livewire.item.item');
    }
}
