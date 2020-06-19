<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\category;
use Auth;
class categoryController extends Controller
{
    //---- Category View ----//
    public function view(){
    	$categories = category::select('id','name')->get();
    	return view('layouts.Backend.categories.categoryView', compact('categories'));
    }
    //---- Category Add ----//
    public function add(){
    	return view('layouts.Backend.categories.categoryAdd');
    }
    //---- Category Store ----//
    public function store(Request $request){
        // validation
        $validation = $request->validate([
        	'name'    => 'required',
        ]);
        // Insert Data
        $category = new category;
        $category->name       = $request->name;
        $category->created_by = Auth::user()->id;
        $category->save();
      // Redirect 
      return redirect()->route('category.view')->with('success', 'Category Added Successfully');
    }
    //---- Category Edit ----//
    public function edit($id){
    	$categoriesEdit = category::find($id);
        return view('layouts.Backend.categories.categoryEdit', compact('categoriesEdit'));
    }
    //---- Category Update ----//
    public function update($id, Request $request){
    	// Update
    	$unitUpdate = category::find($id);
    	$unitUpdate->name       = $request->name;
        $unitUpdate->updated_by = Auth::user()->id;
        $unitUpdate->save();
    	// Redirect 
      return redirect()->route('category.view')->with('success', 'Category Updated Successfully');
    }
     //---- Category Delete ----//
    public function delete($id){
    	// Delete
        $caategoryDelete = category::find($id);
        $caategoryDelete->delete();
        // Redirect 
      return redirect()->route('category.view')->with('error', 'Category Deleted Successfully');
    }
     //---- Category Single View ----//
    public function single($id){
        $categorySingle = category::find($id);
        return view('layouts.Backend.categories.categorySingle', compact('categorySingle'));
    }
}
