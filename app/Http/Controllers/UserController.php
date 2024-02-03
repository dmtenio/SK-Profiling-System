<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        //
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
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
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
