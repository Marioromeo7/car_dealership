<?php

namespace Database\Factories;

use App\Models\car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\carImage>
 */
class carImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img_path' => $this->faker->imageUrl(),
            'position' => function (array $attributes) {
                car::find($attributes['car_id'])->images()->count() + 1;
            },
        ];
    }
}
