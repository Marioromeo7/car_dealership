<?php

namespace App\services;

use App\Models\User;
use Illuminate\Http\Request;

class userService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function signup(Request $request){
         User::create(['name'=>$request->input('n1').$request->input('n2'),'email'=>$request->input('email'),'password'=>$request->input('password'),'phone'=>$request->input('phone')]);
    }
    public function getMatchedUsers(Request $request){
        return User::where('email',$request->input('email'))->get();
    }
    public function checkPass(Request $request, User $user){
        return $request->input('password')==$user->password;
    }
    public function getUserByID($id){
        return User::find($id);
    }
    public function getUserCars($id){
        return User::find($id)->cars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc')->get();
    }
}
