<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\maker;
use App\Models\User;
use Illuminate\Http\Request;

class carController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find(1)->cars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc')->paginate(10);
        return view('car.index',['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show',['car'=>$car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(){
        $user=User::find(1);
        $query=car::where('published_at','<',now())->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->orderBy('published_at','desc');
        $cars=$query->paginate(15);
        return view('car.search',['cars'=>$cars,'carCount'=>$cars->total(),'user'=>$user]);
    }
    public function watchlist(){
        $user=User::find(4);
        $cars=User::find(4)->favouriteCars()->with(['PrimaryImage','city','maker','model','CarType','FuelType'])->paginate(5);
        return view('car.watchlist',['cars'=>$cars,'user'=>$user]);
    }
    public function changefavourability(Request $request){
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
        return redirect()->back()->with('inwatch',$inwatch);
    }


}
