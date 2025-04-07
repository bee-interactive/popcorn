<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'description' => $this->description,
            'email' => $this->email,
            'language' => $this->language,
            'public_profile' => $this->public_profile,
            'tmdb_token' => $this->tmdb_token,
            'profile_picture' => $this->profilePictureUrl(),
        ];
    }
}
