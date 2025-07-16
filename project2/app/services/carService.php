<?php

namespace App\services;

use App\Data\carDTOData;
use App\Data\favoriteDTOData;
use App\Http\DataTransferObjects\CarDTO;
use App\Http\DataTransferObjects\DTOInterface;
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
    public function change_favourite(FavoriteDTO|DTOInterface $favoriteDTO){
        $favoriteDTO->validate();
        $data = $favoriteDTO->toArray();
        $car=car::find($data['car_id']);
        $user=User::find($data['user_id']);
        $inwatch=!$data['inwatch'];
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
        return car::where('published_at','<',now())->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->orderBy('published_at','desc');
    }
    public function delCar(string $id){
        car::destroy($id);
    }
    public function createCar(CarDTO | DTOInterface $carDTO){
        car::create($carDTO->toArray());
    }
    public function editCar(CarDTO | DTOInterface $carDTO, car $car){
        $car->update($carDTO->toArray());
    }
}
