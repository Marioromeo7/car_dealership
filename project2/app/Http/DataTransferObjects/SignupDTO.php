<?php

namespace App\Http\DataTransferObjects;

use App\Http\DataTransferObjects\BaseDTO;
use App\Enum\Tenant\SellerInvoiceAction;
use App\Enum\Tenant\SellerInvoiceStatus;
use App\Rules\ValidatePhoneNumber;
use App\Services\Tenant\OrderShipment\OrderShipmentService;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class SignupDTO extends BaseDTO
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $phone
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->get('n1') . $request->get('n2'),
            email: $request->get('email'),
            password: $request->get('password'),
            phone: $request->get('phone')
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            name: Arr::get($data, 'n1') . ' ' . Arr::get($data, 'n2'),
            email: Arr::get($data, 'email'),
            password: Arr::get($data, 'password'),
            phone: Arr::get($data, 'phone')
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ];
    }
}