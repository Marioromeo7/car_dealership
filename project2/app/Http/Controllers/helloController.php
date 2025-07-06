<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\User;
use Illuminate\Http\Request;

class helloController extends Controller
{
    function index(){
        $cars=car::where('published_at','<',now())->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->orderBy('published_at','desc')->get();
        $user=User::find(1);
        return view("home",['cars'=>$cars,'user'=>$user]);
    }
}
