<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}

        <livewire:wishlist.create-wishlist />
    </flux:main>
</x-layouts.app.sidebar>
