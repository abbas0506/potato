<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Storage;
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
        ]);
        DB::beginTransaction();

        try {
            $cost = Cost::create([
                'commission0' => $request->commission0,
                'bagprice0' => $request->bagprice0,
                'selector' => $request->bagprice0,
                'sorting' => $request->bagprice0,
                'commission0' => $request->bagprice0,
                'commission1' => $request->bagprice0,
                'bagprice0' => $request->bagprice0,
                'bagprice1' => $request->bagprice0,
                'packing0' => $request->bagprice0,
                'packing1' => $request->bagprice0,
                'loading0' => $request->bagprice0,
                'loading1' => $request->bagprice0,
                'carriage0' => $request->bagprice0,
                'carriage1' => $request->bagprice0,
                'storage0' => $request->bagprice0,
                'storage1' => $request->bagprice0,
                'sadqa' => $request->bagprice0,
                'random' => $request->bagprice0,
                'note' => $request->bagprice0,
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
}