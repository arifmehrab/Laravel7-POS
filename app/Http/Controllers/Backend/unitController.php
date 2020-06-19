<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\unit;
use Auth;

class unitController extends Controller
{
     //---- Unit View ----//
    public function view(){
    	$units = unit::select('id','name')->get();
    	return view('layouts.Backend.units.unitView', compact('units'));
    }
    //---- Unit Add ----//
    public function add(){
    	return view('layouts.Backend.units.unitAdd');
    }
    //---- Unit Store ----//
    public function store(Request $request){
        // validation
        $validation = $request->validate([
        	'name'    => 'required',
        ]);
        // Insert Data
        $unit = new unit;
        $unit->name       = $request->name;
        $unit->created_by = Auth::user()->id;
        $unit->update_by  = Auth::user()->id;
        $unit->save();
      // Redirect 
      return redirect()->route('unit.view')->with('success', 'Unit Added Successfully');
    }
    //---- Unit Edit ----//
    public function edit($id){
    	$unitsEdit = unit::find($id);
        return view('layouts.Backend.units.unitEdit', compact('unitsEdit'));
    }
    //---- Unit Update ----//
    public function update($id, Request $request){
    	// Update
    	$unitUpdate = unit::find($id);
    	$unitUpdate->update([
    		'name'  => $request->name,
    		'created_by' => Auth::user()->id,
    		'update_by'  => Auth::user()->id
    	]);
    	// Redirect 
      return redirect()->route('unit.view')->with('success', 'Unit Updated Successfully');
    }
     //---- Unit Delete ----//
    public function delete($id){
    	// Delete
        $unitDelete = unit::find($id);
        $unitDelete->delete();
        // Redirect 
      return redirect()->route('unit.view')->with('error', 'Unit Deleted Successfully');
    }
}
