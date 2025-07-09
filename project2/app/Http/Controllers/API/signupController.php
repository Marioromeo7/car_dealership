<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class signupController extends Controller
{
        protected $user_service=new \App\services\userService();
    function createUser(Request $request){
        $this->user_service->signup($request);
    }
}
