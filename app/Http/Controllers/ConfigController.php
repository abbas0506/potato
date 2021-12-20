<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Exception;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $config = Config::find(1);
        return view('admin.configs.edit', compact('config'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
        $request->validate([
            'weightreductionperbori' => 'required',
            'weightreductionpertora' => 'required',
            'commissionperbori' => 'required',
            'commissionpertora' => 'required',
            'materialcostperbori' => 'required',
            'materialcostpertora' => 'required',
            'packingcostperbori' => 'required',
            'packingcostpertora' => 'required',
            'loadingcostperbori' => 'required',
            'loadingcostpertora' => 'required',
        ]);

        try {

            $config->update($request->all());
            return redirect()->route('configs.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->route('configs.index')->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}