<?php

namespace App\Livewire\Trending;

use App\Http\Integrations\Tmdb\Requests\TrendingRequest;
use App\Http\Integrations\Tmdb\TmdbConnector;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class TrendingItems extends Component
{
    public array $results = [];

    public function mount(TmdbConnector $connector)
    {
        $this->results = Cache::remember('trending_items.'.auth()->user()->username, 7200, function () use ($connector) {
            $results = [];

            for ($i = 1; $i <= 6; $i++) {
                $page = $connector->send(new TrendingRequest($i));

                if ($page->failed()) {
                    return [];
                }

                $results = array_merge($results, $page->json('results'));
            }

            return $results;
        });
    }
}
