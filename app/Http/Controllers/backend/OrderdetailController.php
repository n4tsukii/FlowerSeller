<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Orderdetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderdetailRequest;
class OrderdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $list= Orderdetail::where('order_id','=',$id)->orderBy('created_at','desc')->get();
        return view("backend.order.orderdetail",compact("list"));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderdetailRequest $request)
    {
        //
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
    public function status(string $id)
    {
        //
    }
}
