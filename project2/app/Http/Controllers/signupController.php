<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class signupController extends Controller
{
    function create(){
        return view('signup');
    }
    function createUser(Request $request){
        User::create(['name'=>$request->input('n1').$request->input('n2'),'email'=>$request->input('email'),'password'=>$request->input('password'),'phone'=>$request->input('phone')]);
        return redirect('/car');
    }
}
