<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\supplier;
use Auth;
use App\User;

class supplierController extends Controller
{
    //---- Supplier View ----//
    public function view(){
    	$suppliers = supplier::select('id','name','mobile','email','address')->get();
    	return view('layouts.Backend.supplier.supplierView', compact('suppliers'));
    }
    //---- Supplier Add ----//
    public function add(){
    	return view('layouts.Backend.supplier.supplierAdd');
    }
    //---- Supplier Store ----//
    public function store(Request $request){
        // validation
        $validation = $request->validate([
        	'name'    => 'required',
        	'mobile'  => 'required',
        	'email'   => 'required|email'
        ]);
        // Insert Data
        $supplierInsert = new supplier;
        $supplierInsert->name       = $request->name;
        $supplierInsert->mobile     = $request->mobile;
        $supplierInsert->email      = $request->email;
        $supplierInsert->address    = $request->address;
        $supplierInsert->created_by = Auth::user()->id;
        $supplierInsert->save();
      // Redirect 
      return redirect()->route('supplier.view')->with('success', 'Supplier Added Successfully');
    }
    //---- Supplier Edit ----//
    public function edit($id){
        $supplierEdit = supplier::find($id);
        return view('layouts.Backend.supplier.supplierEdit', compact('supplierEdit'));
    }
    //---- Supplier Update ----//
    public function update($id, Request $request){
        // validation
        $validation = $request->validate([
            'name'    => 'required',
            'mobile'  => 'required',
            'email'   => 'required|email'
        ]);
        // Update
        $supplierUpdate = supplier::find($id);
        $supplierUpdate->name       = $request->name;
        $supplierUpdate->mobile     = $request->mobile;
        $supplierUpdate->email      = $request->email;
        $supplierUpdate->address    = $request->address;
        $supplierUpdate->updated_by = Auth::user()->id;
        $supplierUpdate->save();
        // Redirect 
      return redirect()->route('supplier.view')->with('success', 'Supplier Updated Successfully');
    }
     //---- Supplier Delete ----//
    public function delete($id){
        // Delete
        $supplierDelete = supplier::find($id);
        $supplierDelete->delete();
        // Redirect 
      return redirect()->route('supplier.view')->with('error', 'Supplier Deleted Successfully');
    }
}
