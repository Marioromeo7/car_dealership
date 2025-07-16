<?php

namespace App\services;

use App\Data\carDTOData;
use App\Data\favoriteDTOData;
use App\Http\DataTransferObjects\CarDTO;
use App\DataTransferObjects\DTOInterface;
use App\Http\DataTransferObjects\FavoriteDTO;
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
    public function change_favourite(FavoriteDTO $favoriteDTO){
        $favoriteDTO=FavoriteDTO::fromArray(
            $favoriteDTO->toArray()
        );
        $favoriteDTO->validate();
        $data = $favoriteDTO->toArray();
        $car=car::find($favoriteDTO->carId);
        $user=User::find($favoriteDTO->userId);
        $inwatch=!$favoriteDTO->inwatch;
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
    public function createCar(CarDTO $carDTO){
        car::create($carDTO->toArray());
    }
    public function editCar(CarDTO $carDTO, car $car){
        $car->update($carDTO->toArray());
    }
}
