<?php

namespace App\Http\DataTransferObjects;

use App\Http\DataTransferObjects\BaseDTO;
use App\Enum\Tenant\SellerInvoiceAction;
use App\Enum\Tenant\SellerInvoiceStatus;
use App\Rules\ValidatePhoneNumber;
use App\Services\Tenant\OrderShipment\OrderShipmentService;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class FavoriteDTO extends BaseDTO
{
    /**
     * @param string $carId
     * @param string $userId
     * @param bool $inwatch
     */
    public function __construct(
        public readonly string $carId,
        public readonly string $userId,
        public readonly bool $inwatch
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            carId: $request->get('car_id'),
            userId: $request->get('user_id'),
            inwatch: $request->boolean('inwatch')
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            carId: Arr::get($data, 'car_id'),
            userId: Arr::get($data, 'user_id'),
            inwatch: Arr::get($data, 'inwatch', false)
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'car_id' => $this->carId,
            'user_id' => $this->userId,
            'inwatch' => $this->inwatch,
        ];
    }

    public static function rules(): array
    {
        return [
            'car_id' => 'required',//|exists:car,id',
            'user_id' => 'required',//|exists:users,id',
            'inwatch' => 'required|boolean',
        ];
    }
}