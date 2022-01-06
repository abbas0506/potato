<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $deal
        // return view('user.sales.index', compact('deal'));
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
        $request->validate([
            'purchase_id' => 'required',
            'buyer_id' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'grossweight' => 'required',
            'saleprice' => 'required',
            'dateon' => 'required',
        ]);

        try {
            $cost = Cost::create([
                'commission0' => $request->commission0,
                'commission1' => $request->commission1,
                'bagprice0' => $request->bagprice0,
                'bagprice1' => $request->bagprice1,
                'packing0' => $request->packing0,
                'packing1' => $request->packing1,
                'loading0' => $request->loading0,
                'loading1' => $request->loading1,
                'carriage0' => 0,
                'carriage1' => 0,
                'storage0' => 0,
                'storage1' => 0,
                'selector' => $request->selector,
                'sorting' => $request->sorting,
                'random' => $request->random,
                'sadqa' => $request->sadqa,
                'note' => $request->note,
            ]);
            $cost->save();

            $new = Sale::create([
                'purchase_id' => $request->purchase_id,
                'buyer_id' => $request->buyer_id,

                'numofbori' => $request->numofbori,
                'numoftora' => $request->numoftora,
                'reduction0' => $request->reduction0,
                'reduction1' => $request->reduction1,
                'grossweight' => $request->grossweight,
                'saleprice' => $request->saleprice,
                'store_id' => $request->store_id,
                'cost_id' => $cost->id,
                'dateon' => $request->dateon,

            ]);
            $new->save();
            DB::commit(); //commit all changes
            $purchase = Purchase::find($request->purchase_id);
            return redirect()->route('purchases.show', $purchase)->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
        $deal = session('deal');
        $cost = Cost::find($sale->cost_id);
        return view('user.sales.edit', compact('sale', 'deal', 'cost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
        $request->validate([
            'numofbori' => 'required',
            'numoftora' => 'required',
            'commission0' => 'required',
            'commission1' => 'required',
            'bagprice0' => 'required',
            'bagprice1' => 'required',
            'packing0' => 'required',
            'packing1' => 'required',
            'loading0' => 'required',
            'loading1' => 'required',
            'selector' => 'required',
            'sorting' => 'required',
            'random' => 'required',

        ]);

        DB::beginTransaction();

        try {
            //update storage
            $sale->numofbori = $request->numofbori;
            $sale->numoftora = $request->numoftora;
            $sale->reduction0 = $request->reduction0;
            $sale->reduction1 = $request->reduction1;
            $sale->grossweight = $request->grossweight;
            $sale->saleprice = $request->saleprice;
            $sale->update();

            //update related cost parameters
            $cost = Cost::find($sale->cost_id);
            $cost->commission0 = $request->commission0;
            $cost->commission1 = $request->commission1;
            $cost->bagprice0 = $request->bagprice0;
            $cost->bagprice1 = $request->bagprice1;
            $cost->packing0 = $request->packing0;
            $cost->packing1 = $request->packing1;
            $cost->loading0 = $request->loading0;
            $cost->loading1 = $request->loading1;
            $cost->selector = $request->selector;
            $cost->sorting = $request->sorting;
            $cost->random = $request->random;
            $cost->sadqa = $request->sadqa;
            $cost->note = $request->note;
            $cost->update();

            DB::commit(); //commit all changes
            return redirect('purchases/' . $sale->purchase->id)->with('success', 'Successfully created');
        } catch (Exception $e) {
            echo $e->getMessage();
            //return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
        try {
            $sale->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}