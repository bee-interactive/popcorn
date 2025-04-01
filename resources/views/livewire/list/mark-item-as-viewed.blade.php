<div>
    <div class="text-lg border-b">
        <div class="p-4 text-black font-bold">
            {{ __('Mark :item as viewed', ['item' => $item->name]) }}
        </div>
    </div>

    <div class="p-4">
        <div>
            <flux:textarea wire:model="note" rows="auto" label="{{ __('Add a note to this entry') }}" resize="none" />
        </div>
    </div>

    <div class="p-4 rounded-b border-t flex-wrap bg-white flex items-center justify-between">
        <flux:button variant="filled" wire:click.prevent="$dispatch('closeModal')">{{ __('Cancel') }}</flux:button>

        <flux:button variant="primary" autofocus wire:click="save">
            {{ __('Save') }}
        </flux:button>
    </div>
</div>
