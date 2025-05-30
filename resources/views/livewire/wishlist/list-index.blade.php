<div>
    <flux:heading size="xl" level="1">{{ $wishlist->name }}</flux:heading>

    <div class="mt-4">
        <x-elements.search-bar :layout="'minimal'" />
    </div>

    <div class="mt-12">
        @if($wishlist->items->where('watched', 0)->isNotEmpty())
            <flux:separator text="{{ __('Elements') }}" />

            <div class="grid grid-cols-2 gap-2 gap-y-6 lg:gap-y-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 lg:gap-4 pt-4">
                @foreach($wishlist->items->where('watched', 0)->sortByDesc('created_at') as $item)
                    <livewire:item.item :item="$item" :key="$item->id" />
                @endforeach
            </div>
        @else
            <flux:separator text="{{ __('No items yet') }}" />
        @endif
    </div>
</div>
