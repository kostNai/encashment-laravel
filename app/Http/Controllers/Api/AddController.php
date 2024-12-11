<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddController extends Controller
{
    public function getOperationsByUser(string $user_id){
        $user = User::where('id',$user_id)->first();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ],404);
        }
        try {
            $operations = $user->operations->all();
            return response()->json([
                'status'=>true,
                'operations'=>$operations
            ]);
        }catch(HttpResponseException $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ],$exception->getCode());
        }
    }
}
