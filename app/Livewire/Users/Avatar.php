<?php

namespace App\Livewire\Users;

use Flux\Flux;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;

    public $user;

    public $width = 300;

    public $height = 300;

    #[Rule('image|max:6144|dimensions:min_width=300,min_height=300')]
    public $avatar;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function updatedAvatar(): void
    {
        $this->validate();

        $image = getimagesize($this->avatar->getRealPath());

        if ($image[0] / $image[1] === 1) {
            $this->user->addMedia($this->avatar)->toMediaCollection('avatar');

            $this->dispatch('data-updated');
            cache()->flush();

            Flux::toast(
                text: __('The image has been uploaded and saved'),
                variant: 'success',
            );
        } else {
            $this->avatar->storeAs('avatar-uuid', 'avatar-uuid.jpg', 'avatars');

            $this->dispatch('openModal', 'support.crop-image', [
                'image' => $this->avatar->temporaryUrl(),
                'temp_image' => 'avatar-uuid.jpg',
                'uuid' => 'avatar-uuid',
                'model' => \App\Models\User::class,
                'model_id' => auth()->id(),
                'field' => 'avatar',
                'width' => $this->width,
                'height' => $this->height,
            ]);
        }
    }

    public function delete(): void
    {
        $this->user->clearMediaCollection('avatar');

        $this->dispatch('data-updated');
        cache()->flush();

        Flux::toast(
            text: __('The image has been deleted'),
            variant: 'success',
        );
    }
}
