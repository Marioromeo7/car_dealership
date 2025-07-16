<?php

namespace App\Http\DataTransferObjects;

use App\Http\DataTransferObjects\BaseDTO;
use App\Enum\Tenant\SellerInvoiceAction;
use App\Enum\Tenant\SellerInvoiceStatus;
use App\Rules\ValidatePhoneNumber;
use App\Services\Tenant\OrderShipment\OrderShipmentService;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class LoginDTO extends BaseDTO
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            email: $request->get('email'),
            password: $request->get('password')
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            email: Arr::get($data, 'email'),
            password: Arr::get($data, 'password')
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    public static function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}


    /**
 