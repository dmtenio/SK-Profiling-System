<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Purok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurokController extends Controller
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
    public function index(Request $request)
     {
         // Retrieve the authenticated user
         $user = auth()->user();
     
         $barangays = null; // Initialize $barangays variable
         $puroks = null; // Initialize $puroks variable
     
         if ($user) {
             if ($user->account_type == 'barangay_admin' && $user->barangay) {
                 // If user is barangay admin, only show puroks in the same barangay
                 $puroks = Purok::with('barangay.municipality')
                     ->where('barangay_id', $user->barangay->id)
                     ->get();
     
                 $barangays = [$user->barangay];
             } elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                 // If user is municipal admin, show puroks under the municipality
                 $municipality = $user->barangay->municipality;
     
                 $puroks = Purok::with('barangay.municipality')
                     ->whereHas('barangay', function ($query) use ($municipality) {
                         $query->where('municipality_id', $municipality->id);
                     })
                     ->get();
     
                 $barangays = $municipality->barangays;
             } elseif ($user->account_type == 'provincial_admin') {
                 // If user is provincial admin, show all puroks in the province
                 $province = $user->barangay->municipality->province;
     
                 $puroks = Purok::with('barangay.municipality.province')
                     ->whereHas('barangay.municipality', function ($query) use ($province) {
                         $query->where('province_id', $province->id);
                     })
                     ->get();
     
                 $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                     $query->where('province_id', $province->id);
                 })->get();
             } elseif ($user->account_type == 'super_admin') {
                 // If user is super admin, show all puroks
                 $puroks = Purok::with('barangay.municipality.province')->get();
                 $barangays = Barangay::with('municipality.province')->get();
             }
         }
     
         if ($request->ajax()) {
            return DataTables::of($puroks)
                ->addIndexColumn()
                ->addColumn('barangay_name', function ($purok) {
                    return $purok->barangay->name;
                })
                ->addColumn('action', function ($purok) use ($barangays) {
                    // Pass $barangays to the btn view
                    return view('puroks.actions.btn', compact('purok', 'barangays'));
                })
                ->toJson();
        }
        
        
     
         // Share $barangays and $puroks variables before rendering the view
         view()->share('user', $user);
         view()->share('barangays', $barangays);
         view()->share('puroks', $puroks);
     
         return view('puroks.index', compact('barangays', 'puroks'));
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
            'barangay_id' => 'required|exists:barangays,id',
            'name' => 'required|string|max:255',

        ]);
        
        Purok::create([
            'barangay_id' => $request->barangay_id,
            'name'=>$request->name,
        ]);

        //redirect to purok list
        return redirect()->route('puroks.index')->with('success','Purok Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purok  $purok
     * @return \Illuminate\Http\Response
     */
    public function show(Purok $purok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purok  $purok
     * @return \Illuminate\Http\Response
     */
    public function edit(Purok $purok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purok  $purok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purok $purok)
    {
        $request->validate([
            'barangay_id' => 'required|exists:barangays,id',
            'name' => 'required|string|max:255',
        ]);
    
        $purok->update([
            'barangay_id' => $request->barangay_id,
            'name'=>$request->name,
        ]);

        // $name->name=$request->name;
        // $name->save();

          //redirect to purok list
          return redirect()->route('puroks.index')->with('success','Purok Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purok  $purok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purok $purok)
    {
        $purok->delete();

        //redirect to puroks list
        return redirect()->route('puroks.index')->with('success','Purok Successfully deleted!');

    }
}
