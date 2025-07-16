<?php

namespace App\Http\Controllers;


use App\Data\signupDTOData;
use App\Http\DataTransferObjects\SignupDTO;
use App\Http\Requests\signupRequest;
use Illuminate\Http\Request;
use \App\services\userService;
class signupController extends Controller
{
    protected $user_service;
    public function __construct(userService $user_service) {
        $this->user_service=$user_service;
    }
    function create(){
        return view('signup');
    }
    function createUser(signupRequest $request){
        $dto = SignupDTO::fromRequest($request);
        $dto->validate();
        $this->user_service->signup($dto);
        return redirect('/car');
    }
}
