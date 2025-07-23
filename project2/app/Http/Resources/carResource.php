<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class carResource extends JsonResource
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
            'maker' => new makerResource($this->whenLoaded('maker')),
            'model' => new modelResource($this->whenLoaded('model')),
            'year' => $this->year,
            'color' => $this->color,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => new carImageCollection($this->whenLoaded('images')),
        ];
    }
}
