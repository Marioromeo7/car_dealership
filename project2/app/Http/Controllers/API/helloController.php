<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\User;
use Illuminate\Http\Request;

class helloController extends Controller
{
    protected $car_service=new carService();
    protected $user_service=new userService();
        function index(){
        $cars=$this->car_service->getPublishedCars();
        $user=$this->user_service->getUserByID(1);
        return response()->json([
            'cars' => $cars,
            'user' => $user
        ]);
    }
}
