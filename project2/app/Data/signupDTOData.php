<?php

namespace App\Data;

use App\Http\Requests\signupRequest;
use Spatie\LaravelData\Data;

class signupDTOData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phone
    ) {}

    public static function fromRequest(signupRequest $request): self
    {
        return new self(
            name: $request->validated('n1').$request->validated('n2'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            phone: $request->validated('phone')
        );
    }
}
