<div>
    <flux:heading size="xl" level="1">{{ $wishlist->name }}</flux:heading>

    @if($wishlist->items->isNotEmpty())
        <div class="mt-12">
            <flux:separator text="{{ __('Elements') }}" />

            <div class="grid grid-cols-2 gap-2 gap-y-6 lg:gap-y-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 lg:gap-4 pt-4">
                @foreach($wishlist->items->sortByDesc('created_at') as $item)
                    <livewire:item.item :item="$item" :key="$item->id" />
                @endforeach
            </div>
        </div>
    @endif
</div>
