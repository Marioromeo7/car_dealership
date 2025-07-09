<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\services\userService;
class signupController extends Controller
{
    protected $user_service;
    public function __construct(userService $user_service) {
        $this->user_service=$user_service;
    }
    function create(){
        return view('signup');
    }
    function createUser(Request $request){
        $this->user_service->signup($request);
        return redirect('/car');
    }
}
