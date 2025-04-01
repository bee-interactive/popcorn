<div>
    @foreach(auth()->user()->wishlists->sortByDesc('is_favorite') as $wishlist)
        <flux:navlist.item badge="{{ ($wishlist->is_favorite ? '★' : null) }}" href="{{ route('wishlists.show', $wishlist->uuid) }}">{{ $wishlist->name }}</flux:navlist.item>
    @endforeach
</div>
