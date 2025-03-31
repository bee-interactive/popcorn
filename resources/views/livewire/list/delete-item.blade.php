<div>
    <div class="text-lg border-b">
        <div class="p-4 text-black font-bold">
            {{ __('Are you sure?') }}
        </div>
    </div>

    <div class="p-4">
        <h4 class="p-0 m-0">{{ __('The item will be permanently deleted and cannot be recovered') }}</h4>
    </div>

    <div class="p-4 rounded-b border-t flex-wrap bg-white flex items-center justify-between">
        <flux:button variant="filled" wire:click.prevent="$dispatch('closeModal')">{{ __('Cancel') }}</flux:button>

        <flux:button variant="danger" autofocus wire:click="delete">
            {{ __('Yes, delete') }}
        </flux:button>
    </div>
</div>
