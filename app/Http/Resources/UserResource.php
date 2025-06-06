<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'description' => $this->description,
            'email' => $this->email,
            'language' => $this->language,
            'profile_picture' => $this->profilePictureUrl(),
            'items' => ItemResource::collection($this->items),
        ];
    }
}
