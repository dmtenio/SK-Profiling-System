<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
    //     $users=User::get();
    //     return view('users.index',compact('users'));
    // }


    public function index(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();
    
        $barangays = null; // Initialize $barangays variable
        $users = null; // Initialize $users variable
    
        if ($user) {
            if ($user->account_type == 'barangay_admin' && $user->barangay) {
                // If user is barangay admin, only show users in the same barangay
                $users = User::with('barangay.municipality')
                    ->where('barangay_id', $user->barangay->id)
                    ->whereNotIn('account_type', ['municipal_admin', 'provincial_admin', 'super_admin']) // Exclude specified account types
                    ->get();
            
                $barangays = [$user->barangay];
            }
            elseif ($user->account_type == 'municipal_admin' && $user->barangay) {
                // If user is municipal admin, show users under the municipality
                $municipality = $user->barangay->municipality;
            
                $users = User::with('barangay.municipality')
                    ->whereHas('barangay', function ($query) use ($municipality) {
                        $query->where('municipality_id', $municipality->id);
                    })
                    ->whereNotIn('account_type', ['provincial_admin', 'super_admin']) // Exclude specified account types
                    ->get();
            
                $barangays = $municipality->barangays;
            }
            elseif ($user->account_type == 'provincial_admin') {
                // If user is provincial admin, show all users in the province
                $province = $user->barangay->municipality->province;
            
                $users = User::with('barangay.municipality.province')
                    ->whereHas('barangay.municipality', function ($query) use ($province) {
                        $query->where('province_id', $province->id);
                    })
                    ->where('account_type', '!=', 'super_admin') // Exclude super_admin accounts
                    ->get();
            
                $barangays = Barangay::whereHas('municipality', function ($query) use ($province) {
                    $query->where('province_id', $province->id);
                })->get();
            }
             elseif ($user->account_type == 'super_admin') {
                // If user is super admin, show all users
                $users = User::with('barangay.municipality.province')->get();
                $barangays = Barangay::with('municipality.province')->get();
            }
        }
    
        if ($request->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id; // Assuming you want to use the user ID as the row index
                })
                ->addColumn('name', function ($user) {
                    return $user->name;
                })
                ->addColumn('email', function ($user) {
                    return $user->email;
                })
                ->addColumn('position', function ($user) {
                    return $user->position->name;
                })
                ->addColumn('barangay', function ($user) {
                    return $user->barangay->name;
                })
                ->addColumn('account_type', function ($user) {
                    if ($user->account_type === 'barangay_user') {
                        return 'Barangay ' . $user->barangay->name . ' User';
                    } elseif ($user->account_type === 'barangay_admin') {
                        return 'Barangay ' . $user->barangay->name . ' Admin';
                    } elseif ($user->account_type === 'municipal_admin') {
                        return 'Municipal Admin';
                    } elseif ($user->account_type === 'provincial_admin') {
                        return 'Provincial Admin';
                    } elseif ($user->account_type === 'super_admin') {
                        return 'Super Admin';
                    }
                })
                ->addColumn('status', function ($user) {
                    return $user->status === 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($user) {
                    return view('users.actions.btn', compact('user'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }
    
        return view('users.index', compact('users'));
    }
    
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $positions=Position::orderBy('name','asc')->get();
    //     $barangays=Barangay::orderBy('name','asc')->get();
    //     return view('users.create',compact('positions','barangays'));
    // }

    
    public function create()
    {
        $user = auth()->user();
    
        $positions = Position::orderBy('name', 'asc')->get();
        $barangays = Barangay::orderBy('name', 'asc')->get();
    
        if ($user->account_type === 'barangay_admin') {
            $barangays = $barangays->where('id', $user->barangay_id);
        } elseif ($user->account_type === 'municipal_admin') {
            $barangays = $barangays->where('municipality_id', $user->barangay->municipality_id);
        }
    
        return view('users.create', compact('user', 'positions', 'barangays'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'position_id' => 'required',
            'account_type' => 'required',
            'barangay_id' => 'required',
            'avatar' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation for avatar
        ], [
            'avatar.required' => 'The avatar must be provided.',
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
    
        // Hash the password before storing
        $requestData = $request->except('_token');
        $requestData['password'] = Hash::make($request->password);
        $requestData['avatar'] = $avatarPath; // Add avatar path to request data
    
        User::create($requestData);
    
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     $positions = Position::orderBy('name', 'asc')->get();
    //     $barangays = Barangay::orderBy('name', 'asc')->get();
    //     return view('users.edit', [
    //         'user' => $user,
    //         'positions'    => $positions,
    //         'campuses'    => $barangays
    //     ]);
    // }

    public function edit(User $user)
    {
        $authuser = auth()->user();
        $positions = Position::orderBy('name', 'asc')->get();
        $barangays = Barangay::orderBy('name', 'asc')->get();
    
        // Filter barangays based on the user's account type
        if ($authuser->account_type === 'barangay_admin') {
            $barangays = $barangays->where('id', $authuser->barangay_id);
        } elseif ($authuser->account_type === 'municipal_admin') {
            $barangays = $barangays->where('municipality_id', $authuser->barangay->municipality_id);
        }
        return view('users.edit', compact('user', 'positions', 'barangays'));

        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8', // Password is optional
                'position_id' => 'required|exists:positions,id',
                'account_type' => 'required',
                'barangay_id' => 'required|exists:barangays,id',
                'status' => 'required|in:active,inactive', 
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Updated validation for avatar
            ]);
        
            // Update the user's data
            $user->name = $request->name;
            $user->position_id = $request->position_id;
            $user->email = $request->email;
            $user->account_type = $request->account_type;
            
            $user->barangay_id = $request->barangay_id;
            $user->status = $request->status; // Assign status field value
        
            // Update the password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
        
            // Handle avatar update
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar) {
                    Storage::delete('public/' . $user->avatar);
                }
        
                // Save new avatar
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
            }
        
            $user->save();
        
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }


    public function showprofile($id)
    {

        // $positions = Position::orderBy('name', 'asc')->get();
        // $barangays = Barangay::orderBy('name', 'asc')->get();
        $user = User::find($id);
        return view('users-profile', [
            'user' => $user,
            // 'positions' => $positions,
            // 'barangays'    => $barangays
        ]);
    }

    public function updateprofile(Request $request, $id)
    {

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 'position_id' => 'required|exists:positions,id',
            // 'campus_id' => 'required|integer|exists:campuses,id',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the user profile
        $userprofile = User::find($id);

        // Update other fields
        $userprofile->name = $request->name;
        $userprofile->email = $request->email;
        // $userprofile->position_id = $request->position_id;
        // $userprofile->campus_id = $request->campus_id;

        // Handle avatar update
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($userprofile->avatar) {
                Storage::delete('public/' . $userprofile->avatar);
            }

            // Save new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $userprofile->avatar = $avatarPath;
        }

        // Update data
        $userprofile->save();

        return redirect()->back()->with('success', 'Profile successfully updated!');
    }

    public function changePassword(Request $request)
    {
        // Validate the form input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password for the authenticated user
        $user->update(['password' => Hash::make($request->new_password)]);

        // Redirect back to the profile page with a success message
        return redirect()->back()->with('success', 'Password changed successfully.');
    }

}
