<?php

namespace App\Http\DataTransferObjects;

use App\Http\DataTransferObjects\BaseDTO;
use App\Enum\Tenant\SellerInvoiceAction;
use App\Enum\Tenant\SellerInvoiceStatus;
use App\Rules\ValidatePhoneNumber;
use App\Services\Tenant\OrderShipment\OrderShipmentService;
use DateTime;
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
     * @param string $city
     * @param string $vin
     * @param int $mileage
     * @param DateTime $published_at
     * @param string $description
     * @param string $phone
     * @param string $address
     * @param int $user_id
     */
    public function __construct(
        public string $make,
        public string $model,
        public int $year,
        public float $price,
        public string $fuelType,
        public string $carType,
        public string $city,
        public string $vin,
        public int $mileage,
        public ?DateTime $published_at = null,
        public ?string $description = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?int $user_id = 1
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
            city: $request->get('city'),
            vin: $request->get('vin'),
            mileage: $request->get('mileage'),
            published_at: $request->get('published_at') ? $request->get('published_at') : null,
            description: $request->get('description'),
            phone: $request->get('phone'),
            address: $request->get('address'),
            user_id: $request->get('user_id', 1) // Default to user
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
            city: Arr::get($data, 'city'),
            vin: Arr::get($data, 'vin'),
            mileage: Arr::get($data, 'mileage'),
            published_at: Arr::get($data, 'published_at') ? Arr::get($data, 'published_at') : null,
            description: Arr::get($data, 'description'),
            phone: Arr::get($data, 'phone'),
            address: Arr::get($data, 'address'),
            user_id: Arr::get($data, 'user_id', 1) // Default
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'maker_id' => $this->make,
            'model_id' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'fuel_type_id' => $this->fuelType,
            'car_type_id' => $this->carType,
            'city_id' => $this->city,
            'vin' => $this->vin,
            'mileage' => $this->mileage,
            'published_at' => $this->published_at ? $this->published_at : null,
            'description' => $this->description,
            'phone' => $this->phone,
            'address' => $this->address,
            'user_id' => $this->user_id,
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
            'city' => 'required|string|max:100',
            'vin' => 'required|string',
            'mileage' => 'required|integer|min:0',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'user_id' => 'nullable|integer',
        ];
    }
}