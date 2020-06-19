<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\product;
use App\Model\supplier;
use App\Model\unit;
use App\Model\category;
use Auth;

class DefaultController extends Controller
{   
	// Category Show Query With Ajax //
    public function getCategory(Request $request){
       $supplier_id = $request->supplier_id;
       $allCategory = product::select('category_id')->with(['category'])->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
       //dd($allCategory->toArray());
       return response()->json($allCategory);
    }
    // Product Show Query With Ajax //
    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $allProduct  = product::where('category_id',$category_id)->get();
        //dd($allProduct->toArray());
        return response()->json($allProduct);
    }
    // Invoice Show Query With Ajax //
    public function getInvoiceCategory(Request $request){
       $category_id = $request->category_id;
       $allProduct  = product::where('category_id',$category_id)->get();
       //dd($allProduct->toArray());
       return response()->json($allProduct);
    }
    // Invoice Quantity show with Ajax //
    public function getProductQuantity(Request $request){
       $product_id = $request->product_id;
       $productQuantity = product::where('id',$product_id)->first()->quantity;
       //dd($productQuantity);
       return response()->json($productQuantity);
    }
    // Product Wais Report PDF //
    public function getProductWaisReport(Request $request){
      $category_id = $request->category_id;
      $product = product::where('category_id', $category_id)->get();
      //dd($product->toArray());
      return response()->json($product);
    }
}
