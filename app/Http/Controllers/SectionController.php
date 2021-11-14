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
        $registrations = Registration::all();
        $sections = Section::all();
        return view('sections.index', compact('sections', 'registrations'));
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
        $id_as_array = array('id' => $section->id);

        //left over section for movement purpose
        $sections = Section::whereNotIn('id', $id_as_array)->get();
        return view('sections.show', compact('section', 'sections'));
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
    public function viewAssignSection(Section $section)
    {
        //assign section to fee payers only
        $registrations = Registration::whereNotNull('paidat')
            ->whereNull('section_id')
            ->orderBy('group_id')
            ->orderBy('marks', 'desc')
            ->get();
        return view('sections.assign', compact('registrations', 'section'));
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

    public function autoAssignRollNos(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
        ]);

        //auto assign class roll nos
        $section = Section::find($request->section_id);
        $registrations = $section->registrations()
            ->orderBy('group_id')
            ->orderBy('marks', 'desc')
            ->get();
        $sr = 1;
        foreach ($registrations as $registration) {
            $registration->classrollno = $section->id * 100 + $sr;
            $registration->save();
            $sr++;
        }
        return response()->json(['msg' => "Successful"]);
        //}
    }
}