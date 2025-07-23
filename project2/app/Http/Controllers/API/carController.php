<?php

namespace App\Http\Controllers\API;

use App\Data\carDTOData;
use App\Data\favoriteDTOData;
use App\Http\DataTransferObjects\CarDTO;
use App\Http\DataTransferObjects\FavoriteDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\carRequest;
use App\Http\Requests\favoriteRequest;
use App\Http\Resources\carCollection;
use App\Http\Resources\carResource;
use App\Http\Resources\collectiveResource;
use App\Http\Resources\userCollection;
use App\Models\car;
use App\Models\carType;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\state;
use App\services\carService;
use App\services\userService;
use Illuminate\Http\Request;

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
        return carResource::collection($cars);
        // return new carCollection($cars);
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
        return collectiveResource::collection([
            $makers,
            $types,
            $fuels,
            $states
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(carRequest $request)
    {
        $dto = CarDTO::fromRequest($request);
        $dto->validate();
        $this->car_service->createCar($dto);
        return response()->json(['message' => 'Car created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return carResource::collection($car);
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
        return collectiveResource::collection([
            $makers,
            $types,
            $fuels,
            $states
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(carRequest $request, car $car)
    {
        $dto = CarDTO::fromRequest($request);
        $dto->validate();
        $this->car_service->editCar($dto, $car);
        return response()->json(['message' => 'Car updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->car_service->delCar($id);
        return response()->json(['message' => 'Car deleted successfully']);
    }
    public function search(){
        $user=$this->user_service->getUserByID(1); // Assuming user ID 1 is the logged-in user
        $query=$this->car_service->getPublishedCars();
        $cars=$query->paginate(15);
        return carCollection::collection($cars);
    }
    public function watchlist(){
        $user=$this->user_service->getUserByID(4); // Assuming user ID 4 is the logged-in user
        $cars=$this->car_service->getFavourites($user)->get();
        return carCollection::collection($cars);
    }
    public function changefavourability(favoriteRequest $request){
        $dto = FavoriteDTO::fromRequest($request);
        $dto->validate();
        $this->car_service->change_favourite($dto);
        return response()->json(['message' => 'Favourability changed successfully']);
    }
}
