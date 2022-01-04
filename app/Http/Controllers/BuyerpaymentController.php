<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Buyerpayment;
use Illuminate\Http\Request;
use Exception;

class BuyerpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $buyer = Buyer::find($id);
        return view('user.payments.buyer.index', compact('buyer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $buyer = Buyer::find($id);
        return view('user.payments..buyer.create', compact('buyer'));
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
            'buyer_id' => 'required',
            'paid' => 'required',
            'mode' => 'required',
        ]);

        try {
            $buyer = Buyer::find($request->buyer_id);
            $new = Buyerpayment::create($request->all());
            $new->save();
            return redirect()->route('payments.show', 2)->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyerpayment  $buyerpayment
     * @return \Illuminate\Http\Response
     */
    public function show(Buyerpayment $buyerpayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyerpayment  $buyerpayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyerpayment $buyerpayment)
    {
        //
        //$buyerpayment = Buyerpayment::find($id);
        $buyer = $buyerpayment->buyer;
        return view('user.payments.buyer.edit', compact('buyerpayment', 'buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyerpayment  $buyerpayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $buyerpayment = Buyerpayment::find($id);
        $request->validate([
            'paid' => 'required',
        ]);

        try {

            $buyerpayment->update($request->all());
            return redirect()->route('payments.show', 2)->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyerpayment  $buyerpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyerpayment $buyerpayment)
    {
        //
        try {
            $buyerpayment->delete();
            return redirect()->route('payments.show', 2)->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}