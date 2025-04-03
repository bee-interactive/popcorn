<div>
    <div>
        <div>
            <div class="relative h-full w-full">
                <label for="avatar" class="z-0 relative cursor-pointer">
                    @if (auth()->user()->profilePictureUrl())
                        <img src="{{ auth()->user()->profilePictureUrl() }}" class="w-44 z-0 shadow-sm border rounded-xl">
                    @endif

                    <input id="avatar" type="file" wire:model.defer="avatar" class="hidden">
                </label>

                @if (auth()->user()->getLastMedia('avatar'))
                    <div class="absolute bottom-2 right-2 bg-white rounded-sm">
                        <button size="xs" wire:click="delete">
                            <i class="far fa-trash"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        @error('avatar') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
