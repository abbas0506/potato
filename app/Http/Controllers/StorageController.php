<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Purchase;
use App\Models\Storage;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'store_id' => 'required',
            'numofbori' => 'required',
            'numoftora' => 'required',
            'dateon' => 'required',

            'commission0' => 'required',
            'commission1' => 'required',
            'bagprice0' => 'required',
            'bagprice1' => 'required',
            'packing0' => 'required',
            'packing1' => 'required',
            'loading0' => 'required',
            'loading1' => 'required',
            'carriage0' => 'required',
            'carriage1' => 'required',
            'storage0' => 'required',
            'storage1' => 'required',
            'selector' => 'required',
            'sorting' => 'required',
            'random' => 'required',

        ]);
        DB::beginTransaction();

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
                'carriage0' => $request->carriage0,
                'carriage1' => $request->carriage1,
                'storage0' => $request->storage0,
                'storage1' => $request->storage0,
                'selector' => $request->selector,
                'sorting' => $request->sorting,
                'random' => $request->random,
                'sadqa' => 0,
                'note' => $request->note,

            ]);
            $cost->save();

            $new = Storage::create([
                'purchase_id' => $request->purchase_id,
                'store_id' => $request->store_id,
                'numofbori' => $request->numofbori,
                'numoftora' => $request->numoftora,
                'cost_id' => $cost->id,
                'dateon' => $request->dateon,
            ]);
            $new->save();
            DB::commit(); //commit all changes
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
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        //
    }
    public function wastes_create($sid, $pid)
    {
        $deal = session('deal');
        $store = Store::find($sid);
        $purchase = Purchase::find($pid);
        return view('user.wastes.create', compact('store', 'purchase', 'deal'));
    }
}