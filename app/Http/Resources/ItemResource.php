<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'media_type' => $this->media_type,
            'name' => $this->name,
            'synopsis' => $this->synopsis ?: null,
            'backdrop_path' => $this->backdrop_path ?: null,
            'poster_path' => $this->poster_path ?: null,
            'release_date' => $this->release_date ?: null,
            'note' => $this->note ?: null,
            'watched' => $this->watched,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
        ];
    }
}
