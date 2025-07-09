<?php

namespace App\services;

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
    public function change_favourite(Request $request){
                $inwatch=$request->boolean('inwatch');
        $car=car::find($request->input('car_id'));
        $user=User::find($request->input('user_id'));
        $inwatch=!$inwatch;
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
        return $user->favouriteCars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc')->get();
    }
    public function getPublishedCars(){
        return car::where('published_at','<',now())->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->orderBy('published_at','desc');
    }
    public function delCar(string $id){
        car::destroy($id);
    }
    public function createCar(Request $request){
        car::create(request()->all());
    }
    public function editCar(Request $request, car $car){
        $car->update($request->all());
    }
}
