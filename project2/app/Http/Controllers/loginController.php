<?php

namespace App\Http\Controllers;
use App\Data\loginDTOData;
use App\Http\DataTransferObjects\LoginDTO;
use App\Http\Requests\loginRequest;
use App\services\userService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    protected $user_service;

    public function __construct(userService $user_service)
    {
        $this->user_service = $user_service;
    }
    function create(){
        return view('login');
    }
    function getUser(loginRequest $request){
        $dto = LoginDTO::fromRequest($request);
        $dto->validate();
        $users=$this->user_service->getMatchedUsers($dto);
         // Check if no users found
        if(count($users)==0){
            return redirect("/signup");
        }else{
            foreach($users as $user){
                if($this->user_service->checkPass($dto, $user)){
                    return redirect('/car');
                }
            }
            return redirect("/signup");
        }
    }
}
