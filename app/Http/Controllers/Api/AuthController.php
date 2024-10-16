<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = User::where('username',$username)->first();
        dd($user->password);

        if(!$username || !$password){
            return response()->json([
                'status'=>false,
                'message'=>'Усі поля мають бути заповнені'
            ],500);
        }
        if($username!==$user->username){
            return response()->json([
                'status'=>false,
                'message'=>'Невірний логін'
            ],404);
        }
        if(!Hash::check($user->password,$password)){
            return response()->json([
                'status'=>false,
                'message'=>'Невірний пароль'
            ],404);
        }

        return response()->json([
            'status'=>true,
            'user'=>$user
        ]);
    }

}
