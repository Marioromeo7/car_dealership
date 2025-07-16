<?php

namespace App\services;

use App\Data\loginDTOData;
use App\Data\signupDTOData;
use App\Http\DataTransferObjects\DTOInterface;
use App\Http\DataTransferObjects\LoginDTO;
use App\Http\DataTransferObjects\SignupDTO;
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
    public function signup(SignupDTO | DTOInterface $signupDTOData){
        User::create(['name'=>$signupDTOData->name,'email'=>$signupDTOData->email,'password'=>$signupDTOData->password,'phone'=>$signupDTOData->phone]);
    }
    public function getMatchedUsers(LoginDTO|DTOInterface $loginDTOData){
        return User::where('email',$loginDTOData->email)->get();
    }
    public function checkPass(LoginDTO|DTOInterface $loginDTOData, User $user){
        return $loginDTOData->password==$user->password;
    }
    public function getUserByID($id){
        return User::find($id);
    }
    public function getUserCars($id){
        return User::find($id)->cars()->with(['PrimaryImage','maker','model'])->orderBy('created_at', 'desc');
    }
}
