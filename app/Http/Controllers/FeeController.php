<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class FeeController extends Controller
{
    //
    public function index()
    {
        $registrations = Registration::orderBy('id', 'desc')->get();
        return view('fee.index', compact('registrations'));
    }

    function payfee(Request $request, $id)
    {
        $today = date('Y-m-d');
        $registration = Registration::find($id);
        $registration->paidat = $today;
        $registration->save();

        return redirect()->back()
            ->with('success', 'Fee has been paid by ' . $registration->name);
    }

    function showcancelfee()
    {
        $registrations = Registration::where('paidat', '!=', null)->get();
        return view('fee.cancel', compact('registrations'));
    }
    function cancelfee(Request $request, $id)
    {
        $registration = Registration::find($id);
        $registration->paidat = null;
        $registration->save();

        return redirect()->back()
            ->with('success', 'Fee cancelled successfully; form no. ' . $registration->id);
    }
}