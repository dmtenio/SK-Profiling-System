<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangayController extends Controller
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
        // Retrieve the authenticated user
        $user = auth()->user();

        $municipalities = []; // Initialize $municipalities variable as an empty array
        $barangays = null; // Initialize $barangays variable

        if ($user) {
            if ($user->account_type == 'municipal_admin' && $user->barangay && $user->barangay->municipality) {
                // If user is municipal admin, show barangays under the municipality
                $municipality = $user->barangay->municipality; // Change variable name to singular
            
                $barangays = Barangay::with('municipality')
                    ->where('municipality_id', $municipality->id) // Use $municipality->id instead of $municipalities->id
                    ->get();

                $municipalities = [$user->barangay->municipality];

                // $municipalities = Municipality::where('id', $municipality->id)->get(); // Change to get municipality by ID
                
            }
            elseif ($user->account_type == 'provincial_admin' && $user->barangay && $user->barangay->municipality && $user->barangay->municipality->province) {
                // If user is provincial admin, show all barangays in the province
                $province = $user->barangay->municipality->province;

                $barangays = Barangay::with('municipality.province')
                    ->whereHas('municipality', function ($query) use ($province) {
                        $query->where('province_id', $province->id);
                    })
                    ->get();

                $municipalities = Municipality::whereHas('province', function ($query) use ($province) {
                    $query->where('province_id', $province->id);
                })->get();


            } elseif ($user->account_type == 'super_admin') {
                // If user is super admin, show all officials
                // $barangays = Barangay::with('municipality.province.region')->get();
                // $municipalities = Municipality::with('province.region')->get();

                $barangays = Barangay::with('municipality')->get();
                $municipalities = Municipality::get();
            }
        }

        if ($request->ajax()) {
            return DataTables::of($barangays)
                ->addIndexColumn()
                ->addColumn('municipality_name', function ($barangay) {
                    return $barangay->municipality->name; // Make sure 'municipality' relation exists
                })
                ->addColumn('action', function ($barangay) use ($municipalities) {
                    return view('barangays.actions.btn', compact('barangay', 'municipalities'));
                })
                ->toJson();
        }


        // Share $municipalities and $barangays variables before rendering the view
        view()->share('user', $user);
        view()->share('municipalities', $municipalities);
        view()->share('barangays', $barangays);

        return view('barangays.index', compact('municipalities', 'barangays'));
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
            'municipality_id' => 'required|exists:municipalities,id',
            'name' => 'required|string|max:255',

        ]);
        
        Barangay::create([
            'municipality_id' => $request->municipality_id,
            'name'=>$request->name,
        ]);

        //redirect to barangay list
        return redirect()->route('barangays.index')->with('success','Barangay Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function show(Barangay $barangay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function edit(Barangay $barangay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barangay $barangay)
    {
        $request->validate([
            'municipality_id' => 'required|exists:municipalities,id',
            'name' => 'required|string|max:255',
        ]);
    
        $barangay->update([
            'municipality_id' => $request->municipality_id,
            'name'=>$request->name,
        ]);

        // $name->name=$request->name;
        // $name->save();

          //redirect to barangay list
          return redirect()->route('barangays.index')->with('success','Barangay Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangay $barangay)
    {
        $barangay->delete();

        //redirect to barangays list
        return redirect()->route('barangays.index')->with('success','Barangay Successfully deleted!');

    }
}
