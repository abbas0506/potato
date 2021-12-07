<?php

namespace App\Http\Controllers;

use App\Models\Transporter;
use Illuminate\Http\Request;
use Exception;

class TransporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transporters = Transporter::orderBy('id', 'desc')->get();
        return view('admin.transporters.index', compact('transporters'));
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        try {

            $new = Transporter::create($request->all());
            $new->save();
            return redirect()->back()->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function show(transporter $transporter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function edit(transporter $transporter)
    {
        //
        return view('admin.transporters.edit', compact('transporter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transporter $transporter)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        try {

            $transporter->update($request->all());
            return redirect()->route('transporters.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->route('transporters.index')->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transporter  $transporter
     * @return \Illuminate\Http\Response
     */
    public function destroy(transporter $transporter)
    {
        //
        try {
            $transporter->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}