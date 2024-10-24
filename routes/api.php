<?php

use App\Http\Controllers\Api\AddController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('/users',UserController::class);
Route::resource('/bills',BillController::class);
Route::resource('/operations',OperationController::class);

Route::controller(AuthController::class)->group(function (){
    Route::post('/login','login');
});
Route::controller(AddController::class)->group(function (){
    Route::get('/get-operations-by-user/{user_id}','getOperationsByUser');
});
