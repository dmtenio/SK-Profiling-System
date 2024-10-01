<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    ///////////////////

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
        
                // Check if the authenticated user is active
                // if (Auth::user()->status === 'active') {
            // Check if the authenticated user is active using the is_active boolean
            if (Auth::user()->is_active) {
                return true;
            } else {
                // If the user is inactive, logout and throw an exception
                Auth::logout();
                throw ValidationException::withMessages([
                    $this->username() => ['Your account is inactive. Please contact your administrator.'],
                ]);
            }
        }

        return false;
    }
    
    ///////////////////


}
