<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login');
        }
    
        //// Debugging statements
        // dd($user->account_type, $roles);
    
        // Check if the user has the required role
        if (!in_array($user->account_type, $roles)) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
    
}
