<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $municipalities = Municipality::with('province.region')->get();
    $provinces = Province::get();
    $regions = Region::get();

    view()->share('municipalities', $municipalities);
    view()->share('provinces', $provinces);
    view()->share('regions', $regions);

    if ($request->ajax()) {
        
        return DataTables::of($municipalities)
            ->addIndexColumn()
            ->addColumn('province_name', function ($municipality) {
                return $municipality->province->name;
            })
            ->addColumn('region_name', function ($municipality) {
                return $municipality->province->region->name;
            })
            ->addColumn('action', function ($municipality) {
                return view('municipalities.actions.btn', compact('municipality'));
            })
            ->toJson();
    }

    return view('municipalities.index', compact('municipalities', 'provinces', 'regions'));
}


    //AJAX for dependent select2
    public function getProvinces($regionId)
    {
        $provinces = Province::where('region_id', $regionId)->get();
        return response()->json($provinces);
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
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipality $municipality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        //
    }

    

}
