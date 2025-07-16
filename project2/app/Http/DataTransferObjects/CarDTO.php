<?php

namespace App\Http\DataTransferObjects;

use App\Http\DataTransferObjects\BaseDTO;
use App\Enum\Tenant\SellerInvoiceAction;
use App\Enum\Tenant\SellerInvoiceStatus;
use App\Rules\ValidatePhoneNumber;
use App\Services\Tenant\OrderShipment\OrderShipmentService;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class CarDTO extends BaseDTO
{
    /**
     * @param string $make
     * @param string $model
     * @param int $stock
     * @param float $price
     * @param int $year
     * @param string $fuelType
     * @param string $carType
     * @param string $state
     * @param string $city
     */
    public function __construct(
        public string $make,
        public string $model,
        public int $year,
        public float $price,
        public string $fuelType,
        public string $carType,
        public string $state,
        public string $city
    )
    {
    }

    public static function fromRequest($request): CarDTO
    {
        return new self(
            make: $request->get('make'),
            model: $request->get('model'),
            year: $request->get('year'),
            price: $request->get('price'),
            fuelType: $request->get('fuel_type'),
            carType: $request->get('car_type'),
            state: $request->get('state'),
            city: $request->get('city')
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): CarDTO
    {
        return new self(
            make: Arr::get($data, 'make'),
            model: Arr::get($data, 'model'),
            year: Arr::get($data, 'year'),
            price: Arr::get($data, 'price'),
            fuelType: Arr::get($data, 'fuel_type'),
            carType: Arr::get($data, 'car_type'),
            state: Arr::get($data, 'state'),
            city: Arr::get($data, 'city')
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'fuel_type' => $this->fuelType,
            'car_type' => $this->carType,
            'state' => $this->state,
            'city' => $this->city
        ];
    }

    public static function rules(): array
    {
        return [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1886|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'fuel_type' => 'required|string|max:50',
            'car_type' => 'required|string|max:50',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
        ];
    }
}