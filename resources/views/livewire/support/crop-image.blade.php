<div>
    <div>
        <div class="p-4">
            <flux:heading size="lg">{{ __('Crop your picture') }}</flux:heading>
            {{ __('Your image does not have the right ratio. To deal with this, you can crop your image to the correct size below') }}
        </div>
    </div>

    <div class="p-4">
        <div class="max-h-[500px] relative" wire:ignore x-data="{
            init() {
                const cropper = new Cropper(this.$refs.image, {
                    aspectRatio: {{ $minWidth }}/{{ $minHeight }},
                    autoCropArea: 1,
                    viewMode: 1,
                    minCropBoxWidth: {{ $minWidth }},
                    minCropBoxHeight: {{ $minHeight }},
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

    <div class="p-4 rounded-b border-t flex-wrap bg-white flex items-center justify-between">
        <flux:button wire:click="$dispatch('closeModal')" variant="filled">{{ __('Cancel') }}</flux:button>

        <flux:button wire:click="save" variant="primary">{{ __('Save') }}</flux:button>
    </div>
</div>
