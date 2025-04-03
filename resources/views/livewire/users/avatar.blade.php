<div>
    <div>
        <div>
            <div class="relative w-32 h-32 rounded-sm">
                <div>
                    <div wire:loading class="absolute pointer-events-none bg-slate-400/90 inset-0 z-10 rounded-sm">
                        <div class="w-32 h-32 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 animate-spin text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                    </div>
                </div>

                <label for="avatar" class="z-0 relative cursor-pointer">
                    @if (auth()->user()->profilePictureUrl())
                        <img src="{{ auth()->user()->profilePictureUrl() }}" class="w-32 z-0 shadow-sm border rounded-xl">
                    @endif

                    <input id="avatar" type="file" wire:model.defer="avatar" class="hidden">
                </label>

                @if (auth()->user()->getLastMedia('avatar'))
                    <div class="absolute bottom-1 right-1.5 cursor-pointer">
                        <flux:button icon="trash" size="xs" wire:click="delete" />
                    </div>
                @endif
            </div>
        </div>

        @error('avatar') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
