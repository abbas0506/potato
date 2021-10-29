<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Group;
use App\Models\Bise;
use App\Models\Preschool;
use Illuminate\Http\Request;
use Exception;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $registrations = Registration::orderBy('id', 'desc')->get();
        //$recentpayers = Registration::where('paidAt', now()->format('Y-m-d'))->get('id', 'group_id');
        $recentpayments = Registration::select('group_id', 'fee', 'concession')
            ->join('groups', 'groups.id', 'group_id')
            ->where('paidAt', now()->format('Y-m-d'))
            ->get();


        return view('registrations.index', compact('registrations', 'recentpayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bises = Bise::all();
        $groups = Group::all();
        $preschools = Preschool::all();
        return view('registrations.create', compact('groups', 'bises', 'preschools'));
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
            'dob' => 'required',
            'bform' => 'required',
            'bise_id' => 'required',
            'passyear' => 'required',
            'rollno' => 'required',
            'marks' => 'required',
            'concession' => 'required',
            'group_id' => 'required',

        ]);

        $latest = Registration::create($request->all());

        $latest->createdat = date('Y-m-d'); //today
        $latest->save();

        return redirect()->route('registration.index')
            ->with('success', 'Registration created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
        return view('registrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
        $bises = Bise::all();
        $groups = Group::all();
        $preschools = Preschool::all();
        return view('registrations.edit', compact('registration', 'groups', 'bises', 'preschools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'bform' => 'required',
            'bise_id' => 'required',
            'passyear' => 'required',
            'rollno' => 'required',
            'marks' => 'required',
            'group_id' => 'required',

        ]);
        $registration->group_id = $request->group_id;
        $registration->name = $request->name;
        $registration->phone = $request->phone;
        $registration->dob = $request->dob;
        $registration->bform = $request->bform;
        $registration->bise_id = $request->bise_id;
        $registration->passyear = $request->passyear;
        $registration->rollno = $request->rollno;
        $registration->marks = $request->marks;

        $registration->bloodgroup = $request->bloodgroup;
        $registration->speciality = $request->speciality;
        $registration->address = $request->address;
        $registration->distance = $request->distance;
        $registration->preschool_id = $request->preschool_id;
        $registration->fname = $request->fname;
        $registration->fcnic = $request->fcnic;
        $registration->mname = $request->mname;
        $registration->mcnic = $request->mcnic;
        $registration->grelation = $request->grelation;
        $registration->gname = $request->gname;
        $registration->gcnic = $request->gcnic;
        $registration->profession = $request->profession;
        $registration->income = $request->income;



        $registration->save();

        //Registration::create($request->all());

        return redirect()->route('registration.index')
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
        $registration->delete();

        return redirect()->route('registration.index')
            ->with('success', 'Registration cancelled successfully');
    }
    function registrationfilter(Request $request, $group_id)
    {
        $registrations = Registration::where('group_id', $group_id)->get();
        return view('registrations.index', compact('registrations'));
    }

    public function uploadimage(Request $request, Registration $registration)
    {

        // echo "registration" . $registration->id;
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $registration->id . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $registration->image = $imageName;
        $registration->save();

        return redirect()->route('registration.edit', $registration);
    }
    public function assignClassRollNo()
    {

        $registrations = Registration::orderBy('classrollno')->get();
        return view('registrations.showbyclassrollno', compact('registrations'));
    }

    public function postAutoEnroll(Request $request)
    {
        //auto assign class roll nos. and admission nos. to fee payers only
        // admission nos. will start from given value
        $request->validate([
            'startvalue' => 'required',
        ]);
        $admno = $request->startvalue;
        $registrations = Registration::whereNotNull('paidat')
            ->orderBy('group_id', 'asc')
            ->orderBy('marks', 'desc')
            ->get();
        foreach ($registrations as $registration) {
            $registration->admno = $admno;
            $registration->save();
            $admno++;
        }

        //assign class roll nos.
        $groups = Group::all();
        foreach ($groups as $group) {
            $registrations = $group->registrations()
                ->whereNotNull('paidat')
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();
            $sr = 1;
            foreach ($registrations as $registration) {
                $registration->classrollno = $group->id * 100 + $sr;
                $registration->save();
                $sr++;
            }
        }
        //forward all those who have been successfully enrolled
        $registrations = Registration::whereNotNull('admno')->orderBy('classrollno', 'asc')->get();
        return view('registrations.autoEnrolled', compact('registrations'));
    }
}