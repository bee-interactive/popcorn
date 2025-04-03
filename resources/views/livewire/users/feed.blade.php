<div>
    <flux:heading size="xl" level="1">{{ __('Feed') }}</flux:heading>
    <flux:text class="mt-2">{{ __('Discover items that have been added by others') }}</flux:text>

    <div class="space-y-8 mt-12">
        @foreach($users as $user)
            <flux:card class="max-w-lg p-4">
                <flux:heading size="md">
                    <div class="flex space-x-2">
                        <div>
                            <flux:profile circle :chevron="false" />
                        </div>

                        <div class="flex flex-col">
                            <span>{{ $user['user']['name'] }}</span>
                            <span>&#64;{{ $user['user']['username'] }}</span>
                        </div>
                    </div>
                </flux:heading>

                @foreach($user['elements'] as $date => $items)
                    <div class="mt-4">
                        <ul class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($items as $item)
                                <li>
                                    @if($item['poster_path'])
                                        <img class="shadow-lg rounded w-full h-full" src="https://image.tmdb.org/t/p/w400{{ $item['poster_path'] }}" alt="">
                                    @else
                                        <img class="shadow-lg rounded w-full h-full" src="{{ asset('img/placeholder.jpg') }}" alt="">
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="flex justify-between border-t mt-6 pt-4">
                            <flux:link class="text-sm" variant="ghost" href="{{ route('profile.show', ['username' => $user['user']['username']]) }}">{{ __('View profile') }}</flux:link>
                            <flux:text class="text-sm">{{ \Carbon\Carbon::parse($date)->diffForHumans() }}</flux:text>
                        </div>
                    </div>
                @endforeach
            </flux:card>
        @endforeach
    </div>
</div>
