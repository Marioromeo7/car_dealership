<?php

namespace App\Data;

use App\Http\Requests\loginRequest;
use Spatie\LaravelData\Data;

class loginDTOData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {
        
    }
    public static function fromRequest(loginRequest $request): self
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
