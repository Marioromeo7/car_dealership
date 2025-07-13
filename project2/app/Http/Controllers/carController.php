<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\carType;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\state;
use App\services\userService;
use Illuminate\Http\Request;
use \App\services\carService;

class carController extends Controller
{
    protected $car_service;
    protected $user_service;
        public function __construct(carService $car_service,userService $user_Service){
        $this->car_service=$car_service;
        $this->user_service=$user_Service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->user_service->getUserCars(1)->paginate(10);
        return view('car.index',['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = maker::all();
        $types = carType::all();
        $fuels=fuelType::all();
        $states=state::all();
        return view('car.create',['makers'=>$makers,'types'=>$types,'fuels'=>$fuels,'states'=>$states]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->car_service->createCar($request);
        return redirect('/car');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $user = $this->user_service->getUserByID(1); // Assuming user ID 1 is the logged-in user
        return view('car.show',['car'=>$car,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(car $car)
    {
        $makers = maker::all();
        $types = carType::all();
        $fuels=fuelType::all();
        $states=state::all();
        return view('car.edit',['makers'=>$makers,'types'=>$types,'fuels'=>$fuels,'states'=>$states]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, car $car)
    {
        $this->car_service->editCar($request, $car);
        return redirect('/car');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->car_service->delCar($id);
    }
    public function search(){
        $user=$this->user_service->getUserByID(1); // Assuming user ID 1 is the logged-in user
        $query=$this->car_service->getPublishedCars();
        $cars=$query->paginate(15);
        return view('car.search',['cars'=>$cars,'carCount'=>$cars->total(),'user'=>$user]);
    }
    public function watchlist(){
        $user=$this->user_service->getUserByID(4); // Assuming user ID 4 is the logged-in user
        $cars=$this->car_service->getFavourites($user);
        $cars=$cars->paginate(5);
        return view('car.watchlist',['cars'=>$cars,'user'=>$user]);
    }
    public function changefavourability(Request $request){
        return redirect()->back()->with('inwatch',$this->car_service->change_favourite($request));
    }


}
