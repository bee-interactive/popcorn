<?php

namespace App\Livewire\List;

use App\Models\Item as ItemModel;
use Livewire\Component;

class Item extends Component
{
    public ItemModel $item;

    public function mount(ItemModel $item): void
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.list.item');
    }
}
