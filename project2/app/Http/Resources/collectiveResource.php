<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class collectiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'makers' => makerResource::collection($this->makers),
            'states' => stateResource::collection($this->states),
            'types' => typeResource::collection($this->types),
            'fuels' => fuelResource::collection($this->fuels),
        ];
    }
}
