<?php

namespace App\Livewire\List;

use Flux\Flux;
use LivewireUI\Modal\ModalComponent;
use Override;

class DeleteItem extends ModalComponent
{
    public mixed $model;

    #[Override]
    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function mount(string $model, int $model_id): void
    {
        $this->model = app($model)->find($model_id);
    }

    public function delete(): void
    {
        $this->model->delete();

        $this->dispatch('data-updated');

        Flux::toast(
            text: __('The element has been deleted successfully'),
            variant: 'success',
        );

        $this->closeModal();
    }
}
