<div class="px-4 py-6">
    <div class="space-y-6">
        <div class="mb-4">
            <flux:heading size="lg">{{ __('Save :item for later', ['item' => ($this->result['title'] ?? $this->result['name'])]) }}</flux:heading>
        </div>

        <div>
            <flux:select label="{{ __('Choose a list and save this entry.') }}" wire:model="wishlist" variant="listbox" placeholder="Choose wishlist...">
                @foreach(auth()->user()->wishlists->sortBy('is_favorite') as $wishlist)
                    <flux:select.option value="{{ $wishlist->id }}">{{ $wishlist->name }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <div>
            <flux:textarea wire:model="note" rows="auto" label="{{ __('Add a note to this entry') }}" resize="none" />
        </div>

        <div class="flex justify-between items-center">
            <flux:button wire:click="$dispatch('closeModal')" variant="filled">{{ __('Cancel') }}</flux:button>

            <flux:button wire:click="save" variant="primary">{{ __('Save') }}</flux:button>
        </div>
    </div>
</div>
