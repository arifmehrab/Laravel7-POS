<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\product;
use App\Model\supplier;
use App\Model\unit;
use App\Model\category;
use Auth;

class productController extends Controller
{
    //---- Products View ----//
    public function view(){
    	$products = product::all();
    	return view('layouts.Backend.products.productsView', compact('products'));
    }
    //---- Products Add ----//
    public function add(){
        $data['suppliers']  = supplier::select('id','name')->get();
        $data['units']      = unit::select('id','name')->get();
        $data['categories'] = category::select('id','name')->get();
    	return view('layouts.Backend.products.productsAdd', $data);
    }
    //---- Products Store ----//
    public function store(Request $request){
         // validation
        $validation = $request->validate([
        	'supplier_id' => 'required',
        	'unit_id'     => 'required',
        	'category_id' => 'required',
        	'name'        => 'required'
        ]);
        // Insert Data
        $products = new product;
        $products->supplier_id = $request->supplier_id;
        $products->unit_id     = $request->unit_id;
        $products->category_id = $request->category_id;
        $products->name        = $request->name;
        $products->created_by  = Auth::user()->id;
        $products->save();
      // Redirect 
      return redirect()->route('products.view')->with('success', 'product Added Successfully');
    }
    //---- Products Edit ----//
    public function edit($id){
    	$data['suppliers']  = supplier::select('id','name')->get();
        $data['units']      = unit::select('id','name')->get();
        $data['categories'] = category::select('id','name')->get();
        $data['products']   = product::find($id);
    	return view('layouts.Backend.products.productEdit', $data);
    }
    //---- Products Update ----//
    public function update($id, Request $request){
    	// Update
        $productUpdate = product::find($id);
        $productUpdate->supplier_id = $request->supplier_id;
        $productUpdate->unit_id     = $request->unit_id;
        $productUpdate->category_id = $request->category_id;
        $productUpdate->name        = $request->name;
        $productUpdate->updated_by  = Auth::user()->id;
        $productUpdate->save();
        // Redirect 
      return redirect()->route('products.view')->with('success', 'Products Updated Successfully');
    }
     //---- Products Delete ----//
    public function delete($id){
    	// Delete
        $productDelete = product::find($id);
        $productDelete->delete();
        // Redirect 
      return redirect()->route('products.view')->with('error', 'products Deleted Successfully');
    }
}
