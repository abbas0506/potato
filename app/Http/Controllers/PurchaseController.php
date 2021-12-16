<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $deal = session('deal');
        return view('user.purchases.index', compact('deal'));
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
        $stores = Store::all();
        $transporters = Transporter::all();
        return view('user.purchases.create', compact('deal', 'stores', 'transporters'));
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
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'unitprice' => 'required',
            'commission' => 'required',
            'bagscost' => 'required',
            'selectorcost' => 'required',
            'packingcost' => 'required',
            'loadingcost' => 'required',

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

    public function sales_create($id)
    {
        $purchase = Purchase::find($id);
        $deal = $purchase->deal;
        $clients = Client::all();
        $transporters = Transporter::all();
        $stores = Store::all();
        return view('user.sales.create', compact('deal', 'purchase', 'clients', 'transporters', 'stores'));
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