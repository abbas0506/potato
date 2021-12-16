<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Storage;
use App\Models\Store;
use App\Models\Transporter;
use Illuminate\Http\Request;
use Exception;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $deals = Deal::orderBy('id', 'desc')->get();
        return view('user.deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        $clients = Client::all();
        $stores = Store::all();
        $transporters = Transporter::all();
        return view('user.deals.create', compact('products', 'clients', 'stores', 'transporters'));
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
            'client_id' => 'required',
            'product_id' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'unitprice' => 'required',
        ]);

        try {

            $new = deal::create($request->all());
            $new->save();
            return redirect()->route('deals.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(deal $deal)
    {
        //
        session([
            'deal' => $deal,
        ]);
        return view('user.purchases.index', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(deal $deal)
    {
        //
        try {
            $deal->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    public function get_sell($id)
    {
        $deal = deal::find($id);
        $clients = Client::all();
        $transporters = Transporter::all();
        $stores = Store::all();
        return view('user.deals.sell', compact('deal', 'clients', 'transporters', 'stores'));
    }
    public function post_sell(Request $request, $id)
    {
        $request->validate([
            'deal_id' => 'required',
            'client_id' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'transporter_id' => 'required',
            'vehicleno' => 'required',
            'carriage' => 'required',
            'commission' => 'required',
            'saleprice' => 'required',
            'dateon' => 'required',
        ]);

        try {

            $new = Sale::create($request->all());
            $new->save();
            return redirect()->route('deals.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function viewStorage($id)
    {
        $deal = deal::find($id);
        $transporters = Transporter::all();
        $stores = Store::all();
        return view('user.storage.create', compact('deal', 'transporters', 'stores'));
    }
    public function postStorage(Request $request, $id)
    {
        $request->validate([
            'deal_id' => 'required',
            'store_id' => 'required',
            'transporter_id' => 'required',
            'vehicleno' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'carriage' => 'required',
            'storagecost' => 'required',
            'dateon' => 'required',
        ]);

        try {

            $new = Storage::create($request->all());
            $new->save();
            return redirect()->route('deals.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}