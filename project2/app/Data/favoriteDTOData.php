<?php

namespace App\Data;

use App\Http\Requests\favoriteRequest;
use Spatie\LaravelData\Data;

class favoriteDTOData extends Data
{
    public function __construct(
        public readonly string $carId,
        public readonly string $userId,
        public readonly bool $inwatch

    ) {}
    public static function fromRequest(favoriteRequest $request): self
    {
        return new self(
            carId: $request->validated('car_id'),
            userId: $request->validated('user_id'),
            inwatch: $request->boolean('inwatch')
        );
    }
}
