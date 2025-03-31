<flux:modal name="create-wishlist" class="w-[85vw] md:w-lg">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('Create a wishlist') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Give your wishlist a name / topic') }}</flux:text>
        </div>

        <flux:input wire:model="name" label="{{ __('Wishlist name') }}" placeholder="{{ __('Name / topic') }}" />

        <flux:checkbox wire:model="is_favorite" label="{{ __('Add to favorites') }}" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="button" wire:click="save" variant="primary">Save</flux:button>
        </div>
    </div>
</flux:modal>
