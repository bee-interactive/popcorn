<?php

namespace App\Http\Integrations\Tmdb\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchMultiRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected string $search) {}

    public function resolveEndpoint(): string
    {
        return '/search/multi';
    }

    protected function defaultQuery(): array
    {
        return [
            'query' => $this->search,
            'include_adult' => 'false',
            'language' => (auth()->user()->language === 'en' ? 'en-GB' : 'fr-Fr'),
            'page' => 1,
        ];
    }
}
