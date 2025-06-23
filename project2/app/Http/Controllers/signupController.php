<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signupController extends Controller
{
    function create(){
        return view('signup');
    }
}
