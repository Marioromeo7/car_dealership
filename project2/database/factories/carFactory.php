<?php

namespace Database\Factories;

use App\Models\carType;
use App\Models\city;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\car>
 */
class carFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maker_id'=>maker::inRandomOrder()->first()->id,
            'model_id'=>function (array $attributes) {
                return model::Where('maker_id',$attributes['maker_id'])->inRandomOrder()->first()->id;
            },
            'year'=>fake()->year(),
            'price'=>((integer)fake()->randomFloat(2,5,100))*1000,
            'vin'=>strtoupper(Str::random(17)),
            'mileage'=>((integer)fake()->randomFloat(2,5,500))*1000,
            'car_type_id'=>carType::inRandomOrder()->first()->id,
            'fuel_type_id'=>fuelType::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
            'city_id'=>city::inRandomOrder()->first()->id,
            'address'=>fake()->address(),
            'phone'=>function (array $attributes) {
                return User::find($attributes['user_id'])->phone;
            },
            'description'=>fake()->text(20000),
            'published_at'=>fake()->optional(.9)->dateTimeBetween('-1 month','+1 day'),
            'created_at'=>now(),
        ];
    }
}
