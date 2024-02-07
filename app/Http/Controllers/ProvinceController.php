<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = Region::all(); // Fetch regions
        
        $provinces = Province::with(['region'])->get();
        // $provinces = Province::get();

        view()->share('regions', $regions);

        if($request->ajax()){

            return DataTables::of($provinces)
            ->addIndexColumn()
            ->addColumn('action',function($province){
                return view('provinces.actions.btn', compact('province'),);
            })
            ->toJson();
        }

        return view('provinces.index', compact('provinces', 'regions'));


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
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
        ]);
        
        Province::create([
            'region_id' => $request->region_id,
            'name'=>$request->name,
        ]);

        //redirect to province list
        return redirect()->route('provinces.index')->with('success','Province Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
        ]);
    
        $province->update([
            'region_id' => $request->region_id,
            'name' => $request->name,
        ]);

        // $province->name=$request->name;
        // $province->save();

          //redirect to region list
          return redirect()->route('provinces.index')->with('success','Province Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $province->delete();

        //redirect to province list
        return redirect()->route('provinces.index')->with('success','Province Successfully deleted!');

    }
}
