<?php

namespace App\services;

use App\Data\loginDTOData;
use App\Data\signupDTOData;
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
    public function signup(signupDTOData $signupDTOData){
        User::create(['name'=>$signupDTOData->name,'email'=>$signupDTOData->email,'password'=>$signupDTOData->password,'phone'=>$signupDTOData->phone]);
    }
    public function getMatchedUsers(loginDTOData $loginDTOData){
        return User::where('email',$loginDTOData->email)->get();
    }
    public function checkPass(loginDTOData $loginDTOData, User $user){
        return $loginDTOData->password==$user->password;
    }
    public function getUserByID($id){
        return User::find($id);
    }
    public function getUserCars($id){
        return User::find($id)->cars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc');
    }
}
