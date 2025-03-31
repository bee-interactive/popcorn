<?php

namespace App\Http\Integrations\Tmdb;

use Illuminate\Support\Facades\Auth;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class TmdbConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return 'https://api.themoviedb.org/3';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer '.(Auth::user() && Auth::user()->tmdb_token ? Auth::user()->tmdb_token : config('services.tmdb.bearer_token')),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
