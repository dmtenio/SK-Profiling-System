<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Official;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class OfficialController extends Controller
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
     
         $positions = Position::get(); // Fetch positions for all cases
         $barangays = null; // Initialize $barangays variable
         $officials = null; // Initialize $officials variable
     
         if ($user) {
             if ($user->account_type == 'barangay_admin' && $user->barangay) {
                 // If user is barangay admin, only show officials in the same barangay
                 $officials = Official::with('barangay.municipality')
                     ->where('barangay_id', $user->barangay->id)
                     ->get();
     
                 $barangays = [$user->barangay];
             } elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                 // If user is municipal admin, show officials under the municipality
                 $municipality = $user->barangay->municipality;
     
                 $officials = Official::with('barangay.municipality')
                     ->whereHas('barangay', function ($query) use ($municipality) {
                         $query->where('municipality_id', $municipality->id);
                     })
                     ->get();
     
                 $barangays = $municipality->barangays;
             } elseif ($user->account_type == 'provincial_admin') {
                 // If user is provincial admin, show all officials in the province
                 $province = $user->barangay->municipality->province;
     
                 $officials = Official::with('barangay.municipality.province')
                     ->whereHas('barangay.municipality', function ($query) use ($province) {
                         $query->where('province_id', $province->id);
                     })
                     ->get();
     
                 $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                     $query->where('province_id', $province->id);
                 })->get();
             } elseif ($user->account_type == 'super_admin') {
                 // If user is super admin, show all officials
                 $officials = Official::with('barangay.municipality.province')->get();
                 $barangays = Barangay::with('municipality.province')->get();
             }
         }
     
         if ($request->ajax()) {
            return DataTables::of($officials)
                ->addIndexColumn()
                ->addColumn('position_name', function ($official) {
                    return $official->position->name;
                })
                ->addColumn('barangay_name', function ($official) {
                    return $official->barangay->name;
                })
                ->addColumn('action', function ($official) use ($positions, $barangays) {
                    // Pass $positions and $barangays to the btn view
                    return view('officials.actions.btn', compact('official', 'positions', 'barangays'));
                })
                ->toJson();
        }
        
        
     
         // Share $barangays and $officials variables before rendering the view
         view()->share('user', $user);
         view()->share('positions', $positions);
         view()->share('barangays', $barangays);
         view()->share('officials', $officials);
     
         return view('officials.index', compact('positions', 'barangays', 'officials'));
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
        $rules = [
            'barangay_id' => 'required|exists:barangays,id',
            'name' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
        ];
    
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'file|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
    
        $request->validate($rules, [
            'avatar.file' => 'The avatar must be a file.',
            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif.',
            'avatar.max' => 'The avatar must not be larger than 2048 kilobytes.',
        ]);
    
        // Handle avatar upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            
            // Check if the uploaded file is really an image
            $mimeType = $avatar->getMimeType();
            if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
                $avatarPath = $avatar->store('avatars', 'public');
            } else {
                return redirect()->back()->with('error', 'The uploaded file is not recognized as an image. Mime Type: ' . $mimeType);
            }
        }
    
        // Create the official
        Official::create([
            'barangay_id' => $request->barangay_id,
            'name' => $request->name,
            'position_id' => $request->position_id,
            'avatar' => $avatarPath, // Add avatar path to official data
        ]);
    
        // Redirect to the official list
        return redirect()->route('officials.index')->with('success', 'Official successfully added!');
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
        $request->validate([
            'barangay_id' => 'required|exists:barangays,id',
            'name' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if a new avatar has been uploaded
        if ($request->hasFile('avatar')) {
            // Handle the new avatar upload
            $avatar = $request->file('avatar');
    
            // Check if the uploaded file is really an image
            $mimeType = $avatar->getMimeType();
            if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
                return redirect()->back()->with('error', 'The uploaded file is not recognized as an image. Mime Type: ' . $mimeType);
            }
    
            // Store the new avatar
            $avatarPath = $avatar->store('avatars', 'public');
    
            // Delete the old avatar if exists
            if ($official->avatar) {
                Storage::disk('public')->delete($official->avatar);
            }
    
            // Update the avatar path in the database
            $official->update(['avatar' => $avatarPath]);
        }
    
        // Update other fields
        $official->update([
            'barangay_id' => $request->barangay_id,
            'name' => $request->name,
            'position_id' => $request->position_id,
        ]);
    
        // Redirect to the official list
        return redirect()->route('officials.index')->with('success', 'Official Successfully updated!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
        $official->delete();

        //redirect to officials list
        return redirect()->route('officials.index')->with('success','Official Successfully deleted!');

    }

   

}
