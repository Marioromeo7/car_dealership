<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    function create(){
        return view('login');
    }
    function getUser(Request $request){
        $users=User::where('email',$request->input('email'))->get();
        if(count($users)==0){
            return redirect("/signup");
        }else{
            foreach($users as $user){
                if($request->input('password')==$user->password){
                    return redirect('/car');
                }
            }
            return redirect("/signup");
        }
    }
}
