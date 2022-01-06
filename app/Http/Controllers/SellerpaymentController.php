<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Seller;
use App\Models\Payment;
use App\Models\Sellerpayment;
use Illuminate\Http\Request;
use Exception;

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
        $sellers = Seller::all();
        return view('user.payments.seller.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $deal = Deal::find($id);
        return view('user.payments.seller.create', compact('deal'));
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
        //
        $request->validate([
            'deal_id' => 'required',
            'seller_id' => 'required',
            'paid' => 'required',
            'mode' => 'required',
        ]);

        try {

            $new = Sellerpayment::create($request->all());
            $new->save();
            return redirect()->route('sellerpayments.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
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
        $deal = $sellerpayment->deal;
        return view('user.payments.seller.edit', compact('sellerpayment', 'deal'));
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
        $request->validate([
            'paid' => 'required',
            'mode' => 'required',
        ]);

        try {

            $sellerpayment->update($request->all());
            return redirect()->route('sellerpayments.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->route('sellerpayments.index')->withErrors($e->getMessage());
            // something went wrong
        }
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
        try {
            $sellerpayment->delete();
            return redirect()->route('sellerpayments.index')->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}