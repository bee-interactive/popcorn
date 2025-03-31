<div class="relative" x-data="{ visible: false }" @mouseover="visible = true" @mouseleave="visible = false">
    <div class="relative h-full">
        <div x-show="visible" x-cloak x-transition:enter="transition ease-out duration-300 opacity-0"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200 opacity-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="absolute rounded flex flex-col justify-between bg-black/80 inset-0 p-4">
            <div>
                <h3 class="transition-all duration-200 leading-4 text-white">{!! $item->name !!}</h3>

                @if($item->synopsis)
                    <div class="mt-4 border-t border-white/60 pt-4">
                        <p class="text-accent-foreground text-sm">{!! str($item->synopsis)->limit(80) !!}</p>
                    </div>
                @endif
            </div>

            <div>
                <div class="flex justify-between">
                    <div class="flex justify-start">
                        <flux:button size="sm" icon="eye"></flux:button>
                    </div>
                    <div class="flex justify-end">
                        <flux:button variant="danger" onclick="Livewire.dispatch('openModal', { component: 'list.delete-item', arguments: { model: 'App\\\Models\\\Item', model_id: {{ $item->id }} }})" size="sm" icon="trash"></flux:button>
                    </div>
                </div>
            </div>
        </div>

        @if($item->poster_path)
            <img class="shadow-lg rounded w-full h-full" src="https://image.tmdb.org/t/p/w400{{ $item->poster_path }}" alt="">
        @else
            <img class="shadow-lg rounded w-full h-full" src="{{ asset('img/placeholder.jpg') }}" alt="">
        @endif
    </div>
</div>
