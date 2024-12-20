<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $bills = Bill::all();
            return response()->json([
                'status'=>true,
                'bills'=>$bills
            ]);
        }catch(HttpResponseException $exception){
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
        try {
            $new_bill  = Bill::create([
                'denomination'=>$request->denomination
            ]);
            return response()->json([
                'status'=>true,
                'bill'=>$new_bill
            ]);
        }catch (HttpResponseException $exception){
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
