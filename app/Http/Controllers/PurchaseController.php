<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Config;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
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
            'dateon' => 'required',
            'deal_id' => 'required',
            'transporter_id' => 'required',
            'vehicleno' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'priceperkg' => 'required',
            'reduction0' => 'required',
            'reduction1' => 'required',
            'selector' => 'required',
            'sorting' => 'required',
            'bagprice0' => 'required',
            'bagprice1' => 'required',
            'packing0' => 'required',
            'packing1' => 'required',
            'loading0' => 'required',
            'loading1' => 'required',
            'commission0' => 'required',
            'commission1' => 'required',
            'random' => 'required',
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
            'reduction0' => 'required',
            'reduction1' => 'required',
            'selector' => 'required',
            'sorting' => 'required',
            'bagprice0' => 'required',
            'bagprice1' => 'required',
            'packing0' => 'required',
            'packing1' => 'required',
            'loading0' => 'required',
            'loading1' => 'required',
            'commission0' => 'required',
            'commission1' => 'required',
            'random' => 'required',
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
        $clients = Client::all();
        $transporters = Transporter::all();
        $stores = $purchase->stores();

        return view('user.sales.fromfield.create', compact('deal', 'purchase', 'clients', 'transporters', 'stores'));
    }
    public function sellfromstore_create($id)
    {
        $purchase = Purchase::find($id);
        $deal = $purchase->deal;
        $clients = Client::all();
        $transporters = Transporter::all();
        $stores = $purchase->stores();
        $config = Config::find(1);

        return view('user.sales.fromstore.create', compact('deal', 'purchase', 'clients', 'transporters', 'stores', 'config'));
    }
    public function storage_create($id)
    {
        $purchase = Purchase::find($id);
        $deal = $purchase->deal;
        $transporters = Transporter::all();
        $stores = Store::all();
        return view('user.storage.create', compact('deal', 'purchase', 'transporters', 'stores'));
    }
}
