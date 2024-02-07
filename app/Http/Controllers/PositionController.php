<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
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
        $positions = Position::get();

        if($request->ajax()){

            // return DataTables::of($positions)->toJson();
            return DataTables::of($positions)
            ->addIndexColumn()
            ->addColumn('action',function($position){
                return view('positions.actions.btn', compact('position'));
                // return '<a href="" class="btn btn-primary btn-sm">Edit</a>';
            })
            ->toJson();
        }

        return view('positions.index',compact('positions'));
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
            'name' => 'required|string|max:255',
        ]);
        
        Position::create([
            'name'=>$request->name,
        ]);

        //redirect to position list
        return redirect()->route('positions.index')->with('success','Position Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $position->update([
            'name' => $request->name,
        ]);

        // $position->name=$request->name;
        // $position->save();

          //redirect to position list
          return redirect()->route('positions.index')->with('success','Position Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        //redirect to position list
        return redirect()->route('positions.index')->with('success','Position Successfully deleted!');

    }
}
