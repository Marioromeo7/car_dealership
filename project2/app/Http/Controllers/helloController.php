<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\User;
use App\services\carService;
use App\services\userService;
use Illuminate\Http\Request;

class helloController extends Controller
{
    protected $car_service;
    protected $user_service;
    public function __construct(carService $car_service,userService $user_service) {
        $this->car_service=$car_service;
        $this->user_service=$user_service;
    }
    function index(){
        $cars=$this->car_service->getPublishedCars();
        $user=$this->user_service->getUserByID(1);
        return view("home",['cars'=>$cars,'user'=>$user]);
    }
}
