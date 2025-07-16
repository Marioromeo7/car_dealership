<?php

namespace App\Http\Controllers\API;

use App\Data\signupDTOData;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\SignupDTO;
use App\Http\Requests\signupRequest;
use App\services\userService;
use Illuminate\Http\Request;

class signupController extends Controller
{
        protected $user_service;
        public function __construct(userService $user_service)
        {
            $this->user_service = $user_service;
        }
    function createUser(signupRequest $request){
        $dto = SignupDTO::fromRequest($request);
        $dto->validate();
        $this->user_service->signup($dto);
        return response()->json(['message' => 'User created successfully']);
    }
}
