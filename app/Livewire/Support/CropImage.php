<?php

namespace App\Livewire\Support;

use Flux\Flux;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Override;
use Spatie\Image\Image;

class CropImage extends ModalComponent
{
    use WithFileUploads;

    public $model;

    public $field;

    public $image;

    public $temp_image;

    public string $uuid;

    public int $x = 0;

    public int $y = 0;

    public int $width = 300;

    public int $height = 300;

    public int $minWidth = 300;

    public int $minHeight = 300;

    #[Override]
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount($image, $temp_image, string $uuid, $model, $model_id, $field, int $width, int $height): void
    {
        $this->image = $image;

        $this->temp_image = $temp_image;

        $this->uuid = $uuid;

        $this->model = app()->make($model)->find($model_id);

        $this->field = $field;

        $this->width = $width;

        $this->height = $height;

        $this->minWidth = $width;

        $this->minHeight = $height;
    }

    public function save(): void
    {
        $crop = Image::load(Storage::disk('avatars')->path($this->uuid.'/'.$this->temp_image));

        $crop->manualCrop($this->width, $this->height, $this->x, $this->y)->save();

        $this->model->addMedia(Storage::disk('avatars')->path($this->uuid.'/'.$this->temp_image))->toMediaCollection('avatar');

        $this->dispatch('data-updated');
        cache()->flush();

        Flux::toast(
            text: __('The image has been uploaded and saved'),
            variant: 'success',
        );

        $this->closeModal();
    }
}
