<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MunicipalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserRole:provincial_admin,super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        $provinces = []; // Initialize $provinces variable as an empty array
        $municipalities = null; // Initialize $municipalities variable

        if ($user) {
            if ($user->account_type == 'provincial_admin' && $user->barangay && $user->barangay->municipality && $user->barangay->municipality->province) {
                // If user is provincial admin, show municipalities under the user's province
                $provinceId = $user->barangay->municipality->province->id;

                $municipalities = Municipality::with('province')
                    ->where('province_id', $provinceId)
                    ->get();

                $provinces = Province::where('id', $provinceId)->get();

            } elseif ($user->account_type == 'super_admin') {
                // If user is super admin, show all municipalities
                $municipalities = Municipality::with('province')->get();
                $provinces = Province::get();
            }
        }

        if ($request->ajax()) {
            return DataTables::of($municipalities)
                ->addIndexColumn()
                ->addColumn('province_name', function ($municipality) {
                    return $municipality->province->name; // Make sure 'province' relation exists
                })
                ->addColumn('action', function ($municipality) use ($provinces) {
                    return view('municipalities.actions.btn', compact('municipality', 'provinces'));
                })
                ->toJson();
        }

        // Share $municipalities and $provinces variables before rendering the view
        view()->share('user', $user);
        view()->share('municipalities', $municipalities);
        view()->share('provinces', $provinces);

        return view('municipalities.index', compact('municipalities', 'provinces'));
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
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',

        ]);
        
        Municipality::create([
            'province_id' => $request->province_id,
            'name'=>$request->name,
        ]);

        //redirect to municipality list
        return redirect()->route('municipalities.index')->with('success','Municipality Successfully added!');

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
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
        ]);
    
        $municipality->update([
            'province_id' => $request->province_id,
            'name'=>$request->name,
        ]);

        // $name->name=$request->name;
        // $name->save();

          //redirect to municipality list
          return redirect()->route('municipalities.index')->with('success','Municipality Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();

        //redirect to municipalities list
        return redirect()->route('municipalities.index')->with('success','Municipality Successfully deleted!');

    }

    

}
