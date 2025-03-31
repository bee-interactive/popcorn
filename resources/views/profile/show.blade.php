<x-layouts.public :title="$user->username . ' - Popcorn'">
    <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
        <x-app-logo />
    </a>

    <div class="flex max-w-5xl mx-auto mt-12 h-full w-full flex-1 flex-col gap-4">
        <div class="grid auto-rows-min gap-4">
            <div class="text-center pb-4">
                <flux:heading size="xl">{{ $user->name }}</flux:heading>
            </div>

            @if($user->items->isNotEmpty())
                <flux:separator text="{{ __('Collection') }}" />

                <div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6 gap-2 gap-y-6 lg:gap-y-4">
                        @foreach($user->items as $item)
                            @if($item->poster_path)
                                <img class="shadow-lg rounded w-full h-full" src="https://image.tmdb.org/t/p/w400{{ $item->poster_path }}" alt="">
                            @else
                                <img class="shadow-lg rounded w-full h-full" src="{{ asset('img/placeholder.jpg') }}" alt="">
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div>{{ __('No items found') }}</div>
            @endif
        </div>
    </div>
</x-layouts.public>
