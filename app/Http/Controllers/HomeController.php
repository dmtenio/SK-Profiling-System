<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Logic to calculate the counts
        $totalYouths = Resident::whereBetween('age', [15, 30])->count();
        $totalMales = Resident::whereBetween('age', [15, 30])->where('gender', 'male')->count();
        $totalFemales = Resident::whereBetween('age', [15, 30])->where('gender', 'female')->count();
        $totalChildYouths = Resident::whereBetween('age', [15, 17])->count();
        $totalCoreYouths = Resident::whereBetween('age', [18, 24])->count();
        $totalYoungAdults = Resident::whereBetween('age', [25, 30])->count();

        $totalOutOfSchoolYouths = Resident::where('youth_classification', 'out_of_school_youth')
        ->whereBetween('age', [15, 30])
        ->count();
        
        $totalRegisteredSKVoters = Resident::where('sk_voter', 'yes')
        ->whereBetween('age', [15, 30])
        ->count();
        $totalOverageYouths = Resident::where('age', '>', 30)->count();

        // Pass the counts to the view
        return view('home', compact('totalYouths', 'totalMales', 'totalFemales', 'totalChildYouths', 'totalCoreYouths', 'totalYoungAdults','totalOutOfSchoolYouths','totalRegisteredSKVoters','totalOverageYouths'));
  
        // return view('home');
    }
}
