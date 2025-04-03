<x-layouts.public :title="$user->name . ' (@'. $user->username .') - Popcorn'">
    <div class="flex justify-between">
        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Create account
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <div class="flex max-w-5xl mx-auto mt-12 h-full w-full flex-1 flex-col gap-4">
        <div class="grid auto-rows-min gap-4">
            <div class="text-center flex flex-col justify-center pb-4">
                <div class="mx-auto mb-2">
                    <img src="{{ $user->profilePictureUrl() }}" alt="{{ $user->name }}" class="rounded-full">
                </div>
                <flux:heading size="xl">{{ $user->name }}</flux:heading>

                <div class="max-w-md mx-auto">
                    <flux:text>&#64;{{ $user->username }}</flux:text>
                    <flux:text class="mt-2">{{ $user->description }}</flux:text>
                </div>
            </div>

            @if($user->items->isNotEmpty())
                <flux:separator text="{{ __('Collection') }}" />

                <div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6 gap-2 gap-y-6 lg:gap-y-4">
                        @foreach($user->items->sortByDesc('created_at') as $item)
                            @if($item->poster_path)
                                <img class="shadow-lg rounded w-full h-full" src="https://image.tmdb.org/t/p/w400{{ $item->poster_path }}" alt="">
                            @else
                                <img class="shadow-lg rounded w-full h-full" src="{{ asset('img/placeholder.jpg') }}" alt="">
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <flux:separator text="{{ __('No items yet') }}" />
            @endif
        </div>
    </div>
</x-layouts.public>
