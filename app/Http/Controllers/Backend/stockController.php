<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\product;
use App\Model\supplier;
use App\Model\category;
use PDF;

class stockController extends Controller
{
    public function stockReport(){
    	$products = product::all();
    	return view('layouts.Backend.stock.stockReport', compact('products'));
    }
    // Stock Report PDF //
    public function stockReportPdf(){
      $data['stocks'] = product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
      $pdf = PDF::loadView('layouts.Backend.pdf.stockReport', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    // supplier/ product wais report //
    public function supplierProductWais(){
    	$date['suppliers'] = supplier::all();
    	$date['categories'] = category::all();
    	return view('layouts.Backend.stock.supplierProductWaisReport', $date);
    }
    // Supplier Wais PDF //
    public function supplierProductWaisPdf(Request $request){
    	$supplier_id = $request->supplier_id;
    	//dd($supplier_id);
    	$data['suppliers'] = product::orderBy('category_id','asc')->orderBy('supplier_id','asc')->where('supplier_id', $supplier_id)->get();
    	$pdf = PDF::loadView('layouts.Backend.pdf.supplierWaisPdfReport', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    	}
    // Product Wais PDF //
    public function productWaisPdf(Request $request){
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        // validation 
        $valiadation  = $request->validate([
            'category_id' => 'required',
            'product_id'  =>  'required'
        ]);
        // product wais report 
        $data['product'] = product::where('category_id', $category_id)->where('id',$product_id)->first();
        $pdf = PDF::loadView('layouts.Backend.pdf.productWaisPdfReport', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
