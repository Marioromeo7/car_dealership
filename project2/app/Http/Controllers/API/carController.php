<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\carType;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\state;
use Illuminate\Http\Request;

class carController extends Controller
{
        protected $car_service=new carService();
    protected $user_service=new userService();
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->user_service->getUserCars(1)->paginate(10);
        return response()->json(['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = maker::all();
        $types = carType::all();
        $fuels=FuelType::all();
        $states=state::all();
        return response()->json(['makers'=>$makers,'types'=>$types,'fuels'=>$fuels,'states'=>$states]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->car_service->createCar($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return response()->json(['car'=>$car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(car $car)
    {
        $makers = maker::all();
        $types = carType::all();
        $fuels=FuelType::all();
        $states=state::all();
        return response()->json(['makers'=>$makers,'types'=>$types,'fuels'=>$fuels,'states'=>$states]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, car $car)
    {
        $this->car_service->editCar($request, $car);
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
        return response()->json(['cars'=>$cars,'carCount'=>$cars->total(),'user'=>$user]);
    }
    public function watchlist(){
        $user=$this->user_service->getUserByID(4); // Assuming user ID 4 is the logged-in user
        $cars=$this->car_service->getFavourites($user)->paginate(5);
        return response()->json(['user'=>$user,'cars'=>$cars]);
    }
    public function changefavourability(Request $request){
        $this->car_service->change_favourite($request);
    }
}
