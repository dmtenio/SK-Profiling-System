<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
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
    // public function index()
    // {
    //     $regions = Region::get();
    //     return view('regions.index',compact('regions'));
    // }
    
    public function index(Request $request)
    {
        $regions = Region::get();

        if($request->ajax()){

            // return DataTables::of($regions)->toJson();
            return DataTables::of($regions)
            ->addIndexColumn()
            ->addColumn('action',function($region){
                return view('regions.actions.btn', compact('region'));
                // return '<a href="" class="btn btn-primary btn-sm">Edit</a>';
            })
            ->toJson();
        }

        return view('regions.index',compact('regions'));
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
            'name' => 'required|string|max:255',
        ]);
        
        Region::create([
            'name'=>$request->name,
        ]);

        //redirect to region list
        return redirect()->route('regions.index')->with('success','Region Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $region->update([
            'name' => $request->name,
        ]);

        // $region->name=$request->name;
        // $region->save();

          //redirect to region list
          return redirect()->route('regions.index')->with('success','Region Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();

        //redirect to region list
        return redirect()->route('regions.index')->with('success','Region Successfully deleted!');

    }
}
