<?php

namespace App\services;

use App\Data\carDTOData;
use App\Data\favoriteDTOData;
use App\Models\car;
use App\Models\User;
use Illuminate\Http\Request;

class carService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function change_favourite(favoriteDTOData $favoriteDTOData){
        $car=car::find($favoriteDTOData->carId);
        $user=User::find($favoriteDTOData->userId);
        $inwatch=!$favoriteDTOData->inwatch;
        if(!$inwatch){
            $car->favoredUsers()->detach([$user->id]);
        }
        else{
            $car->favoredUsers()->attach([$user->id]);
        }
        $user->load('favouriteCars');
        return $inwatch;
    }
    public function getFavourites(User $user){
        return $user->favouriteCars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc');
    }
    public function getPublishedCars(){
        return car::where('published_at','<',now())->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->orderBy('published_at','desc')->get();
    }
    public function delCar(string $id){
        car::destroy($id);
    }
    public function createCar(carDTOData $carDTOData){
        car::create($carDTOData->toArray());
    }
    public function editCar(carDTOData $carDTOData, car $car){
        $car->update($carDTOData->toArray());
    }
}
