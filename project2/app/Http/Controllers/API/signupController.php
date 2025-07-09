<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\services\userService;
use Illuminate\Http\Request;

class signupController extends Controller
{
        protected $user_service;
        public function __construct(userService $user_service)
        {
            $this->user_service = $user_service;
        }
    function createUser(Request $request){
        $this->user_service->signup($request);
    }
}
