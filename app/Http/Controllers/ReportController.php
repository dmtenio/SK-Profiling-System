<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserRole:barangay_admin,municipal_admin,provincial_admin,super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $residents = Resident::get();
    //     return view('reports.index', compact('residents'));

    // }

    public function index()
    {
        $user = auth()->user();
        $residents = Resident::query();

        if ($user) {
            if ($user->account_type == 'barangay_admin' && $user->barangay) {
                // If user is a barangay admin, filter residents by barangay
                $residents->where('barangay_id', $user->barangay->id);
            } elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                // If user is a municipal admin, filter residents by municipality
                $residents->whereIn('barangay_id', function ($query) use ($user) {
                    $query->select('id')
                        ->from('barangays')
                        ->where('municipality_id', $user->barangay->municipality_id);
                });
            } elseif ($user->account_type == 'provincial_admin' && $user->barangay) {
                // If user is a provincial admin, filter residents by province
                $residents->whereIn('barangay_id', function ($query) use ($user) {
                    $query->select('id')
                        ->from('barangays')
                        ->whereIn('municipality_id', function ($subQuery) use ($user) {
                            $subQuery->select('id')
                                    ->from('municipalities')
                                    ->where('province_id', $user->barangay->municipality->province_id);
                        });
                });
            }
        }

        // Fetch filtered residents
        $residents = $residents->get();

        return view('reports.index', compact('residents'));
    }


    // public function print()
    // {
    //     $residents = Resident::all(); // Or fetch residents as needed for the report
        
    //     // Pass data to the view
    //     return view('reports.print_report', compact('residents'));

    // }


    public function print()
    {
        $user = auth()->user();
        $residents = Resident::query();

        if ($user) {
            if ($user->account_type == 'barangay_admin' && $user->barangay) {
                // If user is a barangay admin, filter residents by barangay
                $residents->where('barangay_id', $user->barangay->id);
            } elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                // If user is a municipal admin, filter residents by municipality
                $residents->whereIn('barangay_id', function ($query) use ($user) {
                    $query->select('id')
                        ->from('barangays')
                        ->where('municipality_id', $user->barangay->municipality_id);
                });
            } elseif ($user->account_type == 'provincial_admin' && $user->barangay) {
                // If user is a provincial admin, filter residents by province
                $residents->whereIn('barangay_id', function ($query) use ($user) {
                    $query->select('id')
                        ->from('barangays')
                        ->whereIn('municipality_id', function ($subQuery) use ($user) {
                            $subQuery->select('id')
                                    ->from('municipalities')
                                    ->where('province_id', $user->barangay->municipality->province_id);
                        });
                });
            }
        }

        // Fetch filtered residents
        $residents = $residents->get();

        // Pass data to the view
        return view('reports.print_report', compact('residents'));
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
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident)
    {
        //
    }
}