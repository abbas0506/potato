<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Deal;
use App\Models\Payment;
use App\Models\Seller;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $deal = session('deal');
        return view('user.payments.index', compact('deal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pagecode, $id)
    {
        //
        if ($pagecode == 1) {
            return view('user.payments.seller.create');
        }
        if ($pagecode == 2) {
            $buyer = Buyer::find($id);
            return view('user.payments.buyer.create', compact('buyer'));
        }
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
        $request->validate([
            'deal_id' => 'required',
            'seller_id' => 'required',
            'paid' => 'required',
            'mode' => 'required',
        ]);

        try {

            $new = Payment::create($request->all());
            $new->save();
            return redirect('payments')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if ($id == 1) { //show seller list
            $sellers = Seller::all();
            return view('user.payments.seller.index', compact('sellers'));
        } else { //show buyers list
            $buyers = Buyer::all();
            return view('user.payments.buyer.index', compact('buyers'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
        $deal = session('deal');
        return view('user.payments.edit', compact('deal', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
        $request->validate([
            'paid' => 'required',
            'mode' => 'required',
        ]);

        try {

            $payment->update($request->all());
            return redirect()->route('payments.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->route('payments.index')->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        try {
            $payment->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}