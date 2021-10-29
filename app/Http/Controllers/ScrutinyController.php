<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class ScrutinyController extends Controller
{
    //
    public function index()
    {
        //
        $registrations = Registration::orderBy('id', 'desc')->get();
        return view('scrutiny.index', compact('registrations'));
    }

    public function edit($id)
    {
        //
        $registration = Registration::find($id);
        return view('scrutiny.edit', compact('registration'));
    }
    public function store(Request $request)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
        $registration = Registration::find($id);

        //if an options checked,then update it to 1, else 0
        if ($request->haspics) $registration->haspics = 1;
        else $registration->haspics = 0;

        if ($request->hasgcnic) $registration->hasgcnic = 1;
        else $registration->hasgcnic = 0;

        if ($request->hasbform) $registration->hasbform = 1;
        else $registration->hasbform = 0;

        if ($request->hasmatric) $registration->hasmatric = 1;
        else $registration->hasmatric = 0;

        if ($request->isdobcorrect) $registration->isdobcorrect = 1;
        else $registration->isdobcorrect = 0;

        if ($request->isbformcorrect) $registration->isbformcorrect = 1;
        else $registration->isbformcorrect = 0;

        if ($request->ismarkscorrect) $registration->ismarkscorrect = 1;
        else $registration->ismarkscorrect = 0;

        if ($request->hasnoc) $registration->hasnoc = 1;
        else $registration->hasnoc = 0;

        $registration->save();

        return redirect()->route('registration.index')
            ->with('success', 'Form No. ' . $id . ' updated successfully.');
    }

    public function scrutinize(Request $request, $id)
    {

        $registration = Registration::find($id);
        $numOfDeficiencies = strlen($registration->deficiencyCode());
        if ($numOfDeficiencies > 0) {
            if ($numOfDeficiencies < 5 && $registration->isOtherBoard() || $numOfDeficiencies < 4 && !$registration->isOtherBoard()) {
                return view('scrutiny.edit', compact('registration'));
            } else {
                return view('scrutiny.create', compact('registration'));
            }
        }
        // if($registration->deficiencyCode
        //return view('scrutiny.create', compact('registration'));
    }
}