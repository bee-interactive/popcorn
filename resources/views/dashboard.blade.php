<x-layouts.app :title="__('Dashboard - Popcorn')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4">
            <div>
                @if(Auth::user()->tmdb_token)
                    <livewire:search.search-bar />
                @else
                    <x-elements.configure-token />
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
