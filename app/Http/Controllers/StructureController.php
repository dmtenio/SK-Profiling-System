<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class StructureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserRole:barangay_admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();
        
        // Initialize $officials variable
        $officials = null;
        
        if ($user && $user->account_type == 'barangay_admin') {
            // If user is barangay admin, only show officials in the same barangay
            $officials = Official::with('barangay.municipality')
                ->where('barangay_id', $user->barangay->id)
                ->get();                
        }


        // if ($user && $user->account_type == 'municipal_admin') {
        //     // If user is municipal admin, show officials under the municipality
        //     $municipality = $user->barangay->municipality;
            
        //     // Fetch officials under the municipality
        //     $officials = Official::with('barangay.municipality')
        //         ->whereHas('barangay', function ($query) use ($municipality) {
        //             $query->where('municipality_id', $municipality->id);
        //         })
        //         ->get();
        // }

        return view('structures.index', compact('officials'));

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
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Official $official)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
        //
    }
}
