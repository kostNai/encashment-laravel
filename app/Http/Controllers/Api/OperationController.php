<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $number = Carbon::now()->getTimestamp();
        $user = User::where('id',$request->user_id)->first();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ],404);
        }
        try {
            $newOperation = Operation::create([
                'number'=>$number,
                'user_id'=>$user->id,
            ]);
            $data = $request->operation;
            $operation = Operation::where('id',$newOperation->id)->first();
            foreach($data as $key=>$value) {
                $bill = json_decode(json_encode($value), FALSE);
                $current_bill = Bill::where('denomination',$bill->denomination)->first();
                $operation->bills()->attach([$current_bill->id]);
                $operation->bills()->updateExistingPivot($current_bill->id, [
                    'bills_count' => $operation->bills()->find($current_bill->id)->pivot->bills_count + $bill->bills_count
                ]);
            }
            return response()->json([
                'status'=>true,
                'operation'=>$newOperation
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
