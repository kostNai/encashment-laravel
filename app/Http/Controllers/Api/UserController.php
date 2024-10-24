<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'status'=>true,
                'users'=>$users
            ]);
        }catch (HttpResponseException $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ],$exception->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->username){
            return response()->json([
                'status'=>false,
                'message'=>"Поле логіну обов'язкове"
            ],500);
        }
        if(!$request->email){
            return response()->json([
                'status'=>false,
                'message'=>"Поле email обов'язкове"
            ],500);
        }
        if (!$request->password) {
            return response()->json([
                'status' => false,
                'message' => "Поле паролю обов'язкове"
            ], 500);
        }
        if(strlen($request->password)<4){
            return response()->json([
                'status' => false,
                'message' => "Пароль має бути не коротшим 4 символів"
            ], 500);
        }
        try{
            $user = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'is_admin'=>$request->is_admin,
                'pharmacy_number'=>$request->pharmacy_number

            ]);

            return response()->json([
                'status'=>true,
                'user'=>$user
            ]);
        }catch(HttpResponseException $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ],$exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
