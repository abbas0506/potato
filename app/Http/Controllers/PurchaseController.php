<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Client;
use App\Models\Config;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\Storage;
use App\Models\Store;
use App\Models\Transporter;
use Illuminate\Http\Request;
use Exception;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $deal = session('deal');
        // return view('user.purchases.index', compact('deal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $deal = session('deal');
        $transporters = Transporter::all();
        $config = Config::find(1);
        return view('user.purchases.create', compact('deal', 'transporters', 'config'));
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
            'transporter_id' => 'required',
            'vehicleno' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'priceperkg' => 'required',
            'dateon' => 'required',

        ]);

        try {

            $new = Purchase::create($request->all());
            $new->save();
            return redirect()->route('deals.show', session('deal'))->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
        $deal = $purchase->deal;
        return view('user.purchases.show', compact('deal', 'purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
        $deal = session('deal');
        $transporters = Transporter::all();
        return view('user.purchases.edit', compact('deal', 'transporters', 'purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
        $request->validate([
            'deal_id' => 'required',
            'transporter_id' => 'required',
            'vehicleno' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'priceperkg' => 'required',

        ]);

        try {

            $purchase->update($request->all());
            return redirect()->route('deals.show', session('deal'))->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
        try {
            $purchase->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    public function sellfromfield_create($id)
    {
        $purchase = Purchase::find($id);
        $deal = $purchase->deal;
        $buyers = Buyer::all();
        $transporters = Transporter::all();
        $config = Config::find(1);
        return view('user.sales.fromfield.create', compact('deal', 'purchase', 'buyers', 'config'));
    }
    public function sellfromstore_create($pid, $sid)
    {
        $purchase = Purchase::find($pid);
        $deal = $purchase->deal;
        $buyers = Buyer::all();
        $transporters = Transporter::all();
        $storage = Storage::where('store_id', $sid)->where('purchase_id', $pid)->first();
        $store = $storage->store;

        $config = Config::find(1);

        return view('user.sales.fromstore.create', compact('deal', 'purchase', 'buyers', 'transporters', 'store', 'storage', 'config'));
    }
    public function storage_create($id)
    {
        $purchase = Purchase::find($id);
        $deal = $purchase->deal;
        $transporters = Transporter::all();
        $stores = Store::all();
        $config = Config::find(1);
        return view('user.storage.create', compact('deal', 'purchase', 'stores', 'config'));
    }
}