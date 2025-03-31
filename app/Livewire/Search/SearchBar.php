<?php

namespace App\Livewire\Search;

use App\Http\Integrations\Tmdb\Requests\SearchMultiRequest;
use App\Http\Integrations\Tmdb\TmdbConnector;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchBar extends Component
{
    public array $results = [];

    public string $query = '';

    public function updatedQuery(TmdbConnector $connector): void
    {
        $response = $connector->send(new SearchMultiRequest($this->query));

        $this->results = $response->json('results');
    }

    public function save($result): void
    {
        $this->dispatch('openModal', SaveForLater::class, ['result' => $result]);
    }

    #[On('data-updated')]
    public function render()
    {
        return view('livewire.search.search-bar');
    }
}
