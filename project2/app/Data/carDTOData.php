<?php

namespace App\Data;

use App\Http\Requests\carRequest;
use Spatie\LaravelData\Data;

class carDTOData extends Data
{
    public function __construct(
        public readonly string $make,
        public readonly string $model,
        public readonly int $year,
        public readonly float $price,
        public readonly string $fuelType,
        public readonly string $carType,
        public readonly string $state,
        public readonly string $city

    ) {}
    public static function fromRequest(carRequest $request): self
    {
        return new self(
            make: $request->validated('make'),
            model: $request->validated('model'),
            year: $request->validated('year'),
            price: $request->validated('price'),
            fuelType: $request->validated('fuel_type'),
            carType: $request->validated('car_type'),
            state: $request->validated('state'),
            city: $request->validated('city')
        );
    }
}
