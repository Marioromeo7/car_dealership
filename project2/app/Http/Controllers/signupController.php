<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\services\userService;
class signupController extends Controller
{
    protected $user_service=new \App\services\userService();
    function create(){
        return view('signup');
    }
    function createUser(Request $request){
        $this->user_service->signup($request);
        return redirect('/car');
    }
}
