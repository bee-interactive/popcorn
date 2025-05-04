<div>
    <div>
        <div class="p-4">
            <flux:heading size="lg">{{ __('Crop your picture') }}</flux:heading>

            <flux:text>{{ __('Crop your image below to a square format') }}</flux:text>
        </div>
    </div>

    <div class="p-4">
        <div class="max-h-[500px] relative" wire:ignore x-data="{
            init() {
                const cropper = new Cropper(this.$refs.image, {
                    aspectRatio: {{ $minWidth }}/{{ $minHeight }},
                    autoCropArea: 1,
                    viewMode: 1,
                    minCropBoxWidth: 100,
                    minCropBoxHeight: 100,
                    crop(event) {
                        @this.set('x', event.detail.x)
                        @this.set('y', event.detail.y)
                        @this.set('width', event.detail.width)
                        @this.set('height', event.detail.height)
                    }
                });
            }
        }">
            <img x-ref="image" id="image" src="{{ $image }}" alt="Image">
        </div>
    </div>

    <div class="p-4 rounded-b border-t flex-wrap bg-white dark:border-zinc-600 dark:bg-zinc-950 flex items-center justify-between">
        <flux:button wire:click="$dispatch('closeModal')" variant="filled">{{ __('Cancel') }}</flux:button>

        <flux:button wire:click="save" variant="primary">{{ __('Save') }}</flux:button>
    </div>
</div>
