<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\product;
use App\Model\supplier;
use App\Model\unit;
use App\Model\category;
use App\Model\purchase;
use App\Model\invoice;
use App\Model\invoiceDetail;
use App\Model\payment;
use App\Model\paymentDetail;
use App\Model\customer;
use DB;
use Auth;
use PDF;
class invoiceController extends Controller
{
    //---- Invoice View ----//
    public function view(){
        $data['invoices'] = invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
    	return view('layouts.Backend.invoice.invoiceView', $data);
    }
    //---- Invoice Add ----//
    public function add(){
    	$data['categories'] = category::all();
    	$invoice_no = invoice::orderBy('id','desc')->first();
    	if($invoice_no == null){
    		$firstInvoice = '0';
    		$data['invoiceData']  =  $firstInvoice+1;
    	} else{
    		$invoiceCheck = invoice::orderBy('id','desc')->first()->invoice_no;
    		$data['invoiceData'] = $invoiceCheck+1;
    	}
        $data['customers'] = customer::all();
    	return view('layouts.Backend.invoice.invoiceAdd', $data);
    }
    //---- Invoice Store With Multipal Table ----//
    public function store(Request $request){
        if($request->category_id == null) {
           return redirect()->back()->with('error', 'Sorry! You do not select any product');
        } else{
            if($request->estimated_amount < $request->paid_amount) {
                return redirect()->back()->with('error', 'Sorry! Your Have to pay wright Amount');
            } else{
              // Multipale Data Insert start //
                $invoice = new invoice();
                $invoice->invoice_no  = $request->invoice_no;
                $invoice->date        = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status      = '0';
                $invoice->created_by  = Auth::user()->id;
                DB::transaction(function() use($request,$invoice) {
                   if($invoice->save()) {
                    // Invoice Details Insert Start //
                    $category_id = count($request->category_id);
                    for ($i=0; $i < $category_id; $i++) { 
                        $invoiceDetail = new invoiceDetail();
                        $invoiceDetail->date          = date('Y-m-d', strtotime($request->date));
                        $invoiceDetail->invoice_id    = $invoice->id;
                        $invoiceDetail->category_id   = $request->category_id[$i];
                        $invoiceDetail->product_id    = $request->product_id[$i];
                        $invoiceDetail->selling_qty   = $request->selling_qty[$i];
                        $invoiceDetail->unit_price    = $request->unit_price[$i];
                        $invoiceDetail->selling_price = $request->selling_price[$i];
                        $invoiceDetail->status        = '0';
                        $invoiceDetail->save();
                    }
                    // Invoice Details Insert End //
                    // Customer Data Insert Start //
                    if($request->customer == '0') {
                        $customer = new customer();
                        $customer->name    = $request->name;
                        $customer->mobile  = $request->mobile;
                        $customer->email   = $request->email;
                        $customer->address = $request->address;
                        $customer->save();
                        $customer_id = $customer->id;
                    } else{
                        $customer_id = $request->customer;
                    }
                    // Customer Data Insert End //
                    // Payment Data Insert Start //
                     $payment  = new payment();
                     $paymentDetail = new paymentDetail();
                     $payment->invoice_id      = $invoice->id;
                     $payment->customer_id     = $customer_id;
                     $payment->paid_status     = $request->paid_status;
                     $payment->total_amount    = $request->estimated_amount;
                     $payment->discount_amount = $request->discount_amount;
                     if($request->paid_status == 'full_paid'){
                        $payment->paid_amount = $request->estimated_amount;
                        $payment->due_amount  = '0';
                        $paymentDetail->current_paid_amount = $request->estimated_amount;
                     } elseif($request->paid_status == 'full_due'){
                        $payment->paid_amount = '0';
                        $payment->due_amount  = $request->estimated_amount;
                        $paymentDetail->current_paid_amount = '0';
                     } elseif($request->paid_status == 'Partical_paid'){
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount  = $request->estimated_amount - $request->paid_amount;
                        $paymentDetail->current_paid_amount = $request->paid_amount;
                     }
                     $payment->save();
                     $paymentDetail->invoice_id = $invoice->id;
                     $paymentDetail->date       = date('Y-m-d', strtotime($request->date));
                     $paymentDetail->save();
                    // Payment Data Insert End //
                   }
                });
              // Multipale Data Insert End //
            }
        }
        // Redirect //
        return redirect()->route('invoice.pending.list')->with('success', 'Invoice Added Successfully');
    }
    //---- Invoice Pending List ----//
    public function pendingList(){
        $invoicePending = invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('layouts.Backend.invoice.invoicePendingList', compact('invoicePending'));
    }
    //---- Invoice Approvede ----//
    public function approve($id){
      $data['invoice'] = invoice::with('invoiceDetails')->find($id);
      return view('layouts.Backend.invoice.invoiceApproved', $data);
    }
     //---- Invoice ApprovedProcess ----//
    public function approveprocesses(Request $request, $id){
        foreach($request->selling_qty as $key => $val){
            $invoiceDetail = invoiceDetail::where('id', $key)->first();
            $product  = product::where('id', $invoiceDetail->product_id)->first();
            if($product->quantity < $invoiceDetail->selling_qty) {
                return redirect()->back()->with('error', 'Sorry! Check your Product Stock');
            }
        }
        $invoice  = invoice::find($id);
        $invoice->status = '1';
        $invoice->approved_by = Auth::user()->id;
        DB::transaction(function() use($request,$invoice,$id) {
           foreach($request->selling_qty as $key => $val){
              $invoiceDetail = invoiceDetail::where('id', $key)->first();
              $invoiceDetail->status = '1';
              $invoiceDetail->save();
              $product = product::where('id', $invoiceDetail->product_id)->first();
              $product->quantity = ((float)$product->quantity)-((float)$invoiceDetail->selling_qty);
              $product->save(); 
           }
           $invoice->save();
        });
        // Redirect 
        return redirect()->route('invoice.pending.list')->with('success', 'Invoice approved successfullly');
    }
    // Invoice Print List //
    public function printList(){
        $data['invoices'] = invoice::orderBy('date','desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('layouts.Backend.invoice.invoicePrintList', $data);
    }
    // Invoice Print //
    function print($id) {
    $data['invoice'] = invoice::with('invoiceDetails')->find($id);
    $pdf = PDF::loadView('layouts.Backend.pdf.invoicePrint', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('document.pdf');
   }
   // Invoice Daily //
   public function DailyInvoice(){
    return view('layouts.Backend.invoice.dailyInvoice');
   }
   // Invoice Daily Print //
   public function DailyInvoicePrint(Request $request){
    // validation
    $validation = $request->validate([
        'start_date' => 'required',
        'end_date'   => 'required'
    ]);
     $start_date = date('Y-m-d', strtotime($request->start_date));
     $end_date = date('Y-m-d', strtotime($request->end_date));
     $data['invoices'] = invoice::whereBetween('date', [$start_date, $end_date])->where('status', '1')->get();
     $data['stime'] = date('Y-m-d', strtotime($request->start_date));
     $data['etime'] = date('Y-m-d', strtotime($request->end_date));
     $pdf = PDF::loadView('layouts.Backend.pdf.invoiceDaily', $data);
     $pdf->SetProtection(['copy', 'print'], '', 'pass');
     return $pdf->stream('document.pdf');
   }
    //---- Invoice Delete ----//
    public function delete($id){
      $invoiceDelete = invoice::find($id);
      $invoiceDelete->delete();
      invoiceDetail::where('invoice_id', $invoiceDelete->id)->delete();
      payment::where('invoice_id', $invoiceDelete->id)->delete();
      paymentDetail::where('invoice_id', $invoiceDelete->id)->delete();
      return redirect()->route('invoice.pending.list')->with('success', 'Invoice Deleted successfully');
    }
}
