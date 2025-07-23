<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
                return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'profile_picture' => $this->profile_picture,
            'hashed_password' => $this->password->hashed,
            'password' => $this->password,
            'favorite_cars' => new carCollection($this->favoriteCars), // when relation loaded
        ];
    }
}
