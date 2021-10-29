<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
    public function viewAssignSection()
    {
        //assign section to enrolled students only
        $sections = Section::all();
        $registrations = Registration::whereNotNull('admno')
            ->whereNull('section_id')
            ->orderBy('admno')
            ->get();
        return view('sections.assign', compact('registrations', 'sections'));
    }

    public function postAssignSection(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'ids_array' => 'required',
        ]);
        $section_id = $request->section_id;
        $ids = array();
        $ids = $request->ids_array;
        $id_str = '';
        if ($ids) {
            foreach ($ids as $id) {
                $registration = Registration::find($id);
                $registration->section_id = $section_id;
                $registration->save();
            }
        }
        return response()->json(['msg' => "Successful"]);
    }

    //detach section module

    public function viewDetachSection()
    {
        $sections = Section::all();
        $registrations = Registration::whereNotNull('section_id')->orderBy('classrollno')->get();
        return view('sections.detach', compact('registrations', 'sections'));
    }

    public function postDetachSection(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $registration = Registration::find($request->id);
        $registration->section_id = null;
        $registration->save();

        return response()->json(['msg' => "Successful"]);
    }
    public function postMoveSection(Request $request)
    {
        $request->validate([
            '_id' => 'required',
            'section_id' => 'required',
        ]);
        $registration = Registration::find($request->_id);
        $registration->section_id = $request->section_id;
        $registration->save();
        return redirect()->back()
            ->with('success', "Roll no. " . $registration->classrollno . ' successfully moved to ' . $registration->section->name);
    }
}