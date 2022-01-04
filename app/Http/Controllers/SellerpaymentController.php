<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Sellerpayment;
use Illuminate\Http\Request;

class SellerpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.payments.seller.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sellerpayment  $sellerpayment
     * @return \Illuminate\Http\Response
     */
    public function show(Sellerpayment $sellerpayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sellerpayment  $sellerpayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellerpayment $sellerpayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sellerpayment  $sellerpayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellerpayment $sellerpayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sellerpayment  $sellerpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellerpayment $sellerpayment)
    {
        //
    }
}