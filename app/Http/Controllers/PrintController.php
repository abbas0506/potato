<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Section;
use Barryvdh\DomPDF\Facade as PDF;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('print.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function preview(Request $request)
    {
        //define from, to dates, rectify their format as Y-m-d
        $from = '';
        $to = '';

        if ($request->datefrom) $from = date('Y-m-d', strtotime($request->datefrom));
        if ($request->dateto) $to = date('Y-m-d', strtotime($request->dateto));

        // echo $from . "-" . $to;
        switch ($request->printOption) {
            case 0:
                return $this->previewRegistration($from, $to);
                break;
            case 1:
                return $this->previewFeeCollection($from, $to);
                break;
            case 2:
                return $this->previewDeficiencies();
                break;
            case 3:
                return $this->previewAutoEnrollment();
                break;
            case 4:
                return $this->previewSectionEnrollment();
                break;
            case 5:
                return $this->previewStudentDetail();
                break;
        }
    }

    //preview registration method
    public function previewRegistration($from, $to)
    {
        if ($from && $to) {
            $summary = Registration::whereBetween("createdat", [$from, $to])
                ->select('group_id', DB::raw('count(*) as n, count(paidat) as paidcount'))
                ->groupBy('group_id')
                ->with('group')->get();
            $registrations = Registration::whereBetween("createdat", [$from, $to])
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();
            if ($from == $to)
                $datestr = date('d-m-Y', strtotime($from));
            else
                $datestr = date('d-m-Y', strtotime($from)) . " to " . date('d-m-Y', strtotime($to));
        } else if ($from && !$to) {
            $summary = Registration::where("createdat", ">=", $from)
                ->select('group_id', DB::raw('count(*) as n, count(paidat) as paidcount'))
                ->groupBy('group_id')
                ->with('group')->get();
            $registrations = Registration::where("createdat", ">=", $from)
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();
            $datestr = "Since " . date('d-m-Y', strtotime($from));
        } else if (!$from && $to) {
            $summary = Registration::where("createdat", "<=", $to)
                ->select('group_id', DB::raw('count(*) as n, count(paidat) as paidcount'))
                ->groupBy('group_id', 'group_id')
                ->with('group')->get();
            $registrations = Registration::where("createdat", "<=", $to)
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();
            $datestr = "Till " . date('d-m-Y', strtotime($to));
        } else {
            $summary = Registration::select('group_id', DB::raw('count(*) as n, count(paidat) as paidcount'))
                ->groupBy('group_id')
                ->with('group')->get();
            $registrations = Registration::orderby('group_id')
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();

            $datestr = "All registrations";
        }

        $pdf = PDF::loadView('print.registration', compact('summary', 'registrations', 'datestr'));

        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4')->stream();
    }

    //preview fee method
    public function previewFeeCollection($from, $to)
    {
        if ($from && $to) {
            $summary = Registration::join('groups', 'group_id', '=', 'groups.id')
                ->whereBetween("registrations.paidat", [$from, $to])
                ->where('paidat', '!=', null)
                ->select('paidat', 'groups.*', DB::raw('count(*) as n'), DB::raw('sum(fee) as fee'))
                ->groupBy('paidat')
                ->get();
            $registrations = Registration::whereBetween("paidat", [$from, $to])
                ->where('paidat', '!=', null)
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();

            if ($from == $to)
                $datestr = date('d-m-Y', strtotime($from));
            else
                $datestr = date('d-m-Y', strtotime($from)) . " to " . date('d-m-Y', strtotime($to));
        } else if ($from && !$to) {
            $summary = Registration::join('groups', 'group_id', '=', 'groups.id')
                ->where('paidat', '!=', null)
                ->where("paidat", ">=", $from)
                ->select('paidat', 'groups.*', DB::raw('count(*) as n'), DB::raw('sum(fee) as fee'))
                ->groupBy('paidat')
                ->get();
            $registrations = Registration::where('paidat', '!=', null)
                ->where("paidat", ">=", $from)
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();

            $datestr = " Since " . date('d-m-Y', strtotime($from));
        } else if (!$from && $to) {
            $summary = Registration::join('groups', 'group_id', '=', 'groups.id')
                ->where('paidat', '!=', null)
                ->where("paidat", "<=", $to)
                ->select('paidat', 'groups.*', DB::raw('count(*) as n'), DB::raw('sum(fee) as fee'))
                ->groupBy('paidat')
                ->get();
            $registrations = Registration::where('paidat', '!=', null)
                ->where("paidat", "<=", $to)
                ->orderBy('group_id', 'asc')
                ->orderBy('marks', 'desc')
                ->get();

            $datestr = " Till " . date('d-m-Y', strtotime($to));
        } else {
            $summary = Registration::join('groups', 'group_id', '=', 'groups.id')
                ->where('paidat', '!=', null)
                ->select('paidat', 'groups.*', DB::raw('count(*) as n'), DB::raw('sum(fee) as fee'))
                ->groupBy('paidat')
                ->get();
            $registrations = Registration::where('paidat', '!=', null)
                ->orderBy('paidat', 'asc')
                ->orderBy('marks', 'desc')
                ->get();

            $datestr = "Complete data";
        }
        $summary_bygroup = Registration::select('group_id', DB::raw('count(*) as n, count(paidat) as paidcount'))
            ->groupBy('group_id')
            ->with('group')->get();

        //$datestr;
        $pdf = PDF::loadView('print.feecollection', compact('summary_bygroup', 'summary', 'registrations', 'datestr'));

        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4')->stream();
    }

    public function previewDeficiencies()
    {
        $summary = Registration::whereNotNull('paidat')
            ->select('group_id', DB::raw("sum(if(haspics=0,1,0)) as p, sum(if(hasgcnic=0,1,0)) as c, sum(if(hasbform=0,1,0)) as b, sum(if(hasmatric=0,1,0)) as m, sum(if(bise_id>1 and hasnoc=0,1,0)) as n"))
            ->groupBy('group_id')
            ->with('group')
            ->get();

        $reg_havingDeficiency = Registration::havingDeficiency();
        $reg_havingClearance = Registration::havingClearance();
        $pdf = PDF::loadView('print.deficiencies', compact('summary', 'reg_havingDeficiency', 'reg_havingClearance'));
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4')->stream();
    }

    /*
    *   previw auto enrollment list
    *
    */

    public function previewAutoEnrollment()
    {
        $registrations = Registration::whereNotNull('admno')
            ->orderBy('admno')
            ->get();
        $pdf = PDF::loadView('print.autoEnrollment', compact('registrations'));
        $pdf->output();

        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function previewSectionEnrollment()
    {
        $sections = Section::all();

        $pdf = PDF::loadView('print.sectionEnrollment', compact('sections'));
        $pdf->output();

        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }
    public function previewStudentDetail()
    {
        $sections = Section::all();

        $pdf = PDF::loadView('print.studentDetail', compact('sections'));
        $pdf->output();

        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function printSection($id)
    {
        $section = Section::find($id);
        $pdf = PDF::loadView('print.section', compact('section'));
        $pdf->output();

        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 8, array(0, 0, 0));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }
}