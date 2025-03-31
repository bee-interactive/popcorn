<div>
    @foreach(auth()->user()->wishlists->sortBy('is_favorite') as $wishlist)
        <flux:navlist.item href="{{ route('wishlists.show', $wishlist->uuid) }}">{{ $wishlist->name }}</flux:navlist.item>
    @endforeach
</div>
