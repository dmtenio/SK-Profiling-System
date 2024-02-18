<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Purok;
use App\Models\Region;
use App\Models\Resident;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResidentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserRole:barangay_user,barangay_admin,municipal_admin,provincial_admin,super_admin');

    }


    public function getProvinces($region_id)
    {
        $provinces = Province::where('region_id', $region_id)->get();
        return response()->json($provinces);
    }

    public function getMunicipalities($province_id)
    {
        $municipalities = Municipality::where('province_id', $province_id)->get();
        return response()->json($municipalities);
    }

    public function getBarangays($municipality_id)
    {
        $barangays = Barangay::where('municipality_id', $municipality_id)->get();
        return response()->json($barangays);
    }

    public function getPuroks($barangay_id)
    {
        $puroks = Purok::where('barangay_id', $barangay_id)->get();
        return response()->json($puroks);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entry()
    {

         // Retrieve the authenticated user
         $user = auth()->user();
     
         $puroks = null; // Initialize $puroks variable
         $barangays = null; // Initialize $barangays variable
         $municipalities = null; // Initialize $municipalities variable
         $provinces = null; // Initialize $provinces variable
         $regions = null; // Initialize $regions variable

    
            if ($user->account_type === 'barangay_admin' || $user->account_type === 'barangay_user') {

                $puroks = Purok::with('barangay.municipality')
                ->where('barangay_id', $user->barangay->id)
                ->get();
                $barangays = [$user->barangay];
                $municipalities = [$user->barangay->municipality];
                $provinces = [$user->barangay->municipality->province];
                $regions = [$user->barangay->municipality->province->region];


            } elseif ($user->account_type === 'municipal_admin') {

                $municipality = $user->barangay->municipality;
                $puroks = Purok::with('barangay.municipality')
                    ->whereHas('barangay', function ($query) use ($municipality) {
                        $query->where('municipality_id', $municipality->id);
                    })
                    ->get();
                $barangays = $municipality->barangays;
                $municipalities = [$user->barangay->municipality];
                $provinces = [$user->barangay->municipality->province];
                $regions = [$user->barangay->municipality->province->region];


            } elseif ($user->account_type === 'provincial_admin') {
                $province = $user->barangay->municipality->province;
                $puroks = Purok::with('barangay.municipality.province')
                     ->whereHas('barangay.municipality', function ($query) use ($province) {
                         $query->where('province_id', $province->id);
                     })
                     ->get();
                $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                     $query->where('province_id', $province->id);
                 })->get();

                 $municipalities = Municipality::whereHas('province', function ($query) use ($province) {
                    $query->where('province_id', $province->id);
                })->get();

                $provinces = [$user->barangay->municipality->province];
                $regions = [$user->barangay->municipality->province->region];
                

            } elseif ($user->account_type === 'super_admin') {
                  // If user is super admin, show all puroks
                  $puroks = Purok::with('barangay.municipality.province')->get();
                  $barangays = Barangay::with('municipality.province')->get();
                  $municipalities = Municipality::with('province')->get();
                  $provinces = Province::with('region')->get();
                  $regions = Region::get();


            }
                    
            return view('residents.entry', compact('user','puroks', 'barangays','municipalities','provinces','regions'));
        
    }

    //  public function index()
    // {
    //     //
    // }

    public function index(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();
    
        $barangays = null; // Initialize $barangays variable
        $youths = null; // Initialize $youths variable
    
        if ($user) {
            if ($user->account_type == 'barangay_user' || $user->account_type == 'barangay_admin') {
                // If user is barangay admin, only show users in the same barangay
                $youths = Resident::with('barangay.municipality')
                    ->where('barangay_id', $user->barangay->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    
                $barangays = [$user->barangay];
            } elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                // If user is municipal admin, show users under the municipality
                $municipality = $user->barangay->municipality;
    
                $youths = Resident::with('barangay.municipality')
                    ->whereHas('barangay', function ($query) use ($municipality) {
                        $query->where('municipality_id', $municipality->id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
    
                $barangays = $municipality->barangays;
            } elseif ($user->account_type == 'provincial_admin') {
                // If user is provincial admin, show all users in the province
                $province = $user->barangay->municipality->province;
    
                $youths = Resident::with('barangay.municipality.province')
                    ->whereHas('barangay.municipality', function ($query) use ($province) {
                        $query->where('province_id', $province->id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
    
                $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                    $query->where('province_id', $province->id);
                })->get();
            } elseif ($user->account_type == 'super_admin') {
                // If user is super admin, show all users
                $youths = Resident::with('barangay.municipality.province') ->orderBy('created_at', 'desc')
                ->get();
                $barangays = Barangay::with('municipality.province')->get();
            }
        }
    
        if ($request->ajax()) {
            return DataTables::of($youths)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($youth) {
                    return $youth->id; // Assuming you want to use the user ID as the row index
                })
                ->addColumn('name', function ($youth) {
                    $fullName = $youth->last_name . ', ' . $youth->first_name;
                    
                    if ($youth->middle_name) {
                        $fullName .= ' ' . $youth->middle_name;
                    }
                    
                    if ($youth->suffix) {
                        $fullName .= ' ' . $youth->suffix;
                    }
                    
                    return $fullName;
                })
                
                // ->addColumn('age', function ($youth) {
                //     return $youth->age;
                // })
                ->addColumn('age', function ($youth) {
                    // Calculate the difference in years between the current date and date of birth
                    $dob = new DateTime($youth->dob);
                    $now = new DateTime();
                    $age = $dob->diff($now)->y;
                    
                    return $age;
                })
                
                ->addColumn('gender', function ($youth) {
                    return $youth->gender;
                })
                ->addColumn('civil_status', function ($youth) {
                    return $youth->civil_status;
                })
                ->addColumn('address', function ($youth) {
                    $address = $youth->purok ? $youth->purok->name . ', ' : '';
                    $address .= $youth->barangay->name;
                
                    $userType = auth()->user()->account_type;
                
                    if ($userType === 'barangay_admin' || $userType === 'barangay_user') {
                        // Display Purok, Barangay
                        return $address;
                    } elseif ($userType === 'municipal_admin') {
                        // Display Purok, Barangay, Municipality
                        $address .= ', ' . $youth->barangay->municipality->name;
                    } elseif ($userType === 'provincial_admin') {
                        // Display Purok, Barangay, Municipality, Province
                        $address .= ', ' . $youth->barangay->municipality->province->name;
                    } elseif ($userType === 'super_admin') {
                        // Display Purok, Barangay, Municipality, Province, Region
                        $address .= ', ' . $youth->barangay->municipality->province->region->name;
                    }
                
                    return $address;
                })
                
                ->addColumn('action', function ($youth) {
                    return view('residents.actions.btn', compact('youth'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }
    
        return view('residents.index', compact('youths'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                 // Retrieve the authenticated user
                 $user = auth()->user();
     
                 $puroks = null; // Initialize $puroks variable
                 $barangays = null; // Initialize $barangays variable
                 $municipalities = null; // Initialize $municipalities variable
                 $provinces = null; // Initialize $provinces variable
                 $regions = null; // Initialize $regions variable
        
            
                    if ($user->account_type === 'barangay_admin' || $user->account_type === 'barangay_user') {
        
                        $puroks = Purok::with('barangay.municipality')
                        ->where('barangay_id', $user->barangay->id)
                        ->get();
                        $barangays = [$user->barangay];
                        $municipalities = [$user->barangay->municipality];
                        $provinces = [$user->barangay->municipality->province];
                        $regions = [$user->barangay->municipality->province->region];
        
        
                    } elseif ($user->account_type === 'municipal_admin') {
        
                        $municipality = $user->barangay->municipality;
                        $puroks = Purok::with('barangay.municipality')
                            ->whereHas('barangay', function ($query) use ($municipality) {
                                $query->where('municipality_id', $municipality->id);
                            })
                            ->get();
                        $barangays = $municipality->barangays;
                        $municipalities = [$user->barangay->municipality];
                        $provinces = [$user->barangay->municipality->province];
                        $regions = [$user->barangay->municipality->province->region];
        
        
                    } elseif ($user->account_type === 'provincial_admin') {
                        $province = $user->barangay->municipality->province;
                        $puroks = Purok::with('barangay.municipality.province')
                             ->whereHas('barangay.municipality', function ($query) use ($province) {
                                 $query->where('province_id', $province->id);
                             })
                             ->get();
                        $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                             $query->where('province_id', $province->id);
                         })->get();
        
                         $municipalities = Municipality::whereHas('province', function ($query) use ($province) {
                            $query->where('province_id', $province->id);
                        })->get();
        
                        $provinces = [$user->barangay->municipality->province];
                        $regions = [$user->barangay->municipality->province->region];
                        
        
                    } elseif ($user->account_type === 'super_admin') {
                          // If user is super admin, show all puroks
                          $puroks = Purok::with('barangay.municipality.province')->get();
                          $barangays = Barangay::with('municipality.province')->get();
                          $municipalities = Municipality::with('province')->get();
                          $provinces = Province::with('region')->get();
                          $regions = Region::get();
        
        
                    }
                            
                    return view('residents.create', compact('user','puroks', 'barangays','municipalities','provinces','regions'));
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEntry(Request $request)
    {
         $this->validate($request, [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'purok_id' => 'required|string|max:255',
            'barangay_id' => 'required|string|max:255', 
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer|min:0',
            'mobile_num' => 'nullable|string|max:255',
            'civil_status' => 'required|string', 
            'youth_group' => 'required|string', 
            'educational_background' => 'required|string',
            'youth_classification' => 'required|string', 
            'youth_specific_needs' => 'nullable|string', 
            'work_status' => 'required|string', 
            'sk_voter' => 'required|in:yes,no', 
            'voted_last_sk' => 'required|in:yes,no', 
            'national_voter' => 'required|in:yes,no', 
            'attended_assembly' => 'required|in:yes,no', 
            'attended_yes_how_many' => 'nullable|string|max:255', 
            'attended_no_why' => 'nullable|string|max:255', 
            // 'avatar' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048', 

        ], [
            // 'avatar.required' => 'The avatar must be provided.',
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
    
        $requestData = $request->except('_token');
        $requestData['avatar'] = $avatarPath; // Add avatar path to request data
        $requestData['encoded_by'] = auth()->user()->id;

    
        Resident::create($requestData);
    
        return redirect()->route('residents.entry')->with('success', 'Youth successfully saved!');
    }
        


    public function store(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'purok_id' => 'required|string|max:255',
            'barangay_id' => 'required|string|max:255', 
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer|min:0',
            'mobile_num' => 'nullable|string|max:255',
            'civil_status' => 'required|string', 
            'youth_group' => 'required|string', 
            'educational_background' => 'required|string',
            'youth_classification' => 'required|string', 
            'youth_specific_needs' => 'nullable|string', 
            'work_status' => 'required|string', 
            'sk_voter' => 'required|in:yes,no', 
            'voted_last_sk' => 'required|in:yes,no', 
            'national_voter' => 'required|in:yes,no', 
            'attended_assembly' => 'required|in:yes,no', 
            'attended_yes_how_many' => 'nullable|string|max:255', 
            'attended_no_why' => 'nullable|string|max:255', 
            // 'avatar' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048', 

        ], [
            // 'avatar.required' => 'The avatar must be provided.',
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
    
        $requestData = $request->except('_token');
        $requestData['avatar'] = $avatarPath; // Add avatar path to request data
        $requestData['encoded_by'] = auth()->user()->id;

    
        Resident::create($requestData);
    
        return redirect()->route('residents.index')->with('success', 'Youth successfully saved!');
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
                     // Retrieve the authenticated user
                     $user = auth()->user();
     
                     $puroks = null; // Initialize $puroks variable
                     $barangays = null; // Initialize $barangays variable
                     $municipalities = null; // Initialize $municipalities variable
                     $provinces = null; // Initialize $provinces variable
                     $regions = null; // Initialize $regions variable
            
                
                        if ($user->account_type === 'barangay_admin' || $user->account_type === 'barangay_user') {
            
                            $puroks = Purok::with('barangay.municipality')
                            ->where('barangay_id', $user->barangay->id)
                            ->get();
                            $barangays = [$user->barangay];
                            $municipalities = [$user->barangay->municipality];
                            $provinces = [$user->barangay->municipality->province];
                            $regions = [$user->barangay->municipality->province->region];
            
            
                        } elseif ($user->account_type === 'municipal_admin') {
            
                            $municipality = $user->barangay->municipality;
                            $puroks = Purok::with('barangay.municipality')
                                ->whereHas('barangay', function ($query) use ($municipality) {
                                    $query->where('municipality_id', $municipality->id);
                                })
                                ->get();
                            $barangays = $municipality->barangays;
                            $municipalities = [$user->barangay->municipality];
                            $provinces = [$user->barangay->municipality->province];
                            $regions = [$user->barangay->municipality->province->region];
            
            
                        } elseif ($user->account_type === 'provincial_admin') {
                            $province = $user->barangay->municipality->province;
                            $puroks = Purok::with('barangay.municipality.province')
                                 ->whereHas('barangay.municipality', function ($query) use ($province) {
                                     $query->where('province_id', $province->id);
                                 })
                                 ->get();
                            $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                                 $query->where('province_id', $province->id);
                             })->get();
            
                             $municipalities = Municipality::whereHas('province', function ($query) use ($province) {
                                $query->where('province_id', $province->id);
                            })->get();
            
                            $provinces = [$user->barangay->municipality->province];
                            $regions = [$user->barangay->municipality->province->region];
                            
            
                        } elseif ($user->account_type === 'super_admin') {
                              // If user is super admin, show all puroks
                              $puroks = Purok::with('barangay.municipality.province')->get();
                              $barangays = Barangay::with('municipality.province')->get();
                              $municipalities = Municipality::with('province')->get();
                              $provinces = Province::with('region')->get();
                              $regions = Region::get();
            
            
                        }
                                
                        return view('residents.edit', compact('user','puroks', 'barangays','municipalities','provinces','regions','resident'));
                   
        
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
        $resident->delete();
        return redirect()->route('residents.index')->with('success', 'Youth deleted successfully!');
    }
}
