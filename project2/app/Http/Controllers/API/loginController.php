<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class loginController extends Controller
{
    protected $user_service=new userService();
        function getUser(Request $request){
        $users=$this->user_service->getMatchedUsers($request);
        if(count($users)==0){
            return response()->json([]);
        }else{
            foreach($users as $user){
                if($this->user_service->checkPass($request, $user)){
                    return response()->json(['user'=>$user]);
                }
            }
            return response()->json([]);
        }
    }
}
