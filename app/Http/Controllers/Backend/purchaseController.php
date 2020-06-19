<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\product;
use App\Model\supplier;
use App\Model\unit;
use App\Model\category;
use App\Model\purchase;
use PDF;
use DB;
use Auth;


class purchaseController extends Controller
{
    //---- Purchase View ----//
    public function view(){
        $prachases = purchase::orderBy('date','desc')->orderBy('id','desc')->get();
    	return view('layouts.Backend.purchase.purchaseView', compact('prachases'));
    }
    //---- Purchase Add ----//
    public function add(){
    	$data['suppliers']  = supplier::select('id','name')->get();
        $data['units']      = unit::select('id','name')->get();
        $data['categories'] = category::select('id','name')->get();
    	return view('layouts.Backend.purchase.purchaseAdd',$data);
    }
    // Purchase Store //
    public function store(Request $request){
        if($request->category_id == null){
            return redirect()->back()->with('error', 'Please Purchase The Product');
        } else{
            $category_count = count($request->category_id);
            for ($i=0; $i < $category_count ; $i++) { 
                $purchase = new purchase;
                $purchase->date         = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no  = $request->purchase_no[$i];
                $purchase->supplier_id  = $request->supplier_id[$i];
                $purchase->category_id  = $request->category_id[$i];
                $purchase->product_id   = $request->product_id[$i];
                $purchase->buying_qty   = $request->buying_qty[$i];
                $purchase->unit_price   = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description  = $request->description[$i];
                $purchase->status       = '0';
                $purchase->created_by   = Auth::user()->id;
                $purchase->save();
            }
            // Redirect 
            return redirect()->route('purchase.view')->with('success', 'Purchase Added Successfully');
        }
    }
     // Purchase Delte //
        public function delete($id){
            $purchaseDelete = purchase::find($id);
            $purchaseDelete->delete();
            // Redirect 
            return redirect()->route('purchase.view')->with('error', 'Purchase Deleted Successfully');
        }
    // Purchase Pending List //
      public function pendingList(){
         $prachases = purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('layouts.Backend.purchase.purchasePendingList', compact('prachases'));
      }
    // Purchase Approved //
      public function approve($id){
        $purchase = purchase::find($id);
        $product  = product::where('id', $purchase->product_id)->first();
        $buyingQty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $buyingQty;
        if($product->save()){
            DB::table('purchases')
                ->where('id', $id)
                ->update(['status' => 1]);
        }
        // Redirect 
        return redirect()->route('purchase.pending.list')->with('success', 'Purchase Approved Successfully');
      }
      // Purchase Report //
      public function purchaseReport(){
         return view('layouts.Backend.purchase.purchaseReport');
      }
      // purchase Report PDF //
      public function purchaseReportpdf(Request $request){
         // validation 
        $validation =  $request->validate([
            'start_date' => 'required',
            'end_date'   => 'required'
        ]);
        // Purchase report
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date   = date('Y-m-d', strtotime($request->end_date));
        $data['purchases'] = purchase::whereBetween('date',[$start_date,$end_date])->orderBy('supplier_id')->orderBy('category_id')->where('status', '1')->get();
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate']   = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('layouts.Backend.pdf.purchaseReport', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
      }
}
