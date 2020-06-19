<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\customer;
use App\Model\payment;
use App\Model\invoiceDetail;
use App\Model\paymentDetail;
use Auth;
use PDF;

class customerController extends Controller
{
    //---- Customer View ----//
    public function view(){
    	$customers = customer::select('id','name','mobile','email','address')->get();
    	return view('layouts.Backend.customers.customerView', compact('customers'));
    }
    //---- Customer Add ----//
    public function add(){
    	return view('layouts.Backend.customers.customerAdd');
    }
    //---- Customer Store ----//
    public function store(Request $request){
        // validation
        $validation = $request->validate([
        	'name'    => 'required',
        	'mobile'  => 'required',
        	'email'   => 'required|email'
        ]);
        // Insert Data
        $customer = new customer;
        $customer->name       = $request->name;
        $customer->mobile     = $request->mobile;
        $customer->email      = $request->email;
        $customer->address    = $request->address;
        $customer->created_by = Auth::user()->id;
        $customer->save();
      // Redirect 
      return redirect()->route('customer.view')->with('success', 'Customer Added Successfully');
    }
    //---- Customer Edit ----//
    public function edit($id){
        $customerEdit = customer::find($id);
        return view('layouts.Backend.customers.customerEdit', compact('customerEdit'));
    }
    //---- Customer Update ----//
    public function update($id, Request $request){
        // validation
        $validation = $request->validate([
            'name'    => 'required',
            'mobile'  => 'required',
            'email'   => 'required|email'
        ]);
        // Update
        $customerUpdate = customer::find($id);
        $customerUpdate->name       = $request->name;
        $customerUpdate->mobile     = $request->mobile;
        $customerUpdate->email      = $request->email;
        $customerUpdate->address    = $request->address;
        $customerUpdate->updated_by = Auth::user()->id;
        $customerUpdate->save();
        // Redirect 
      return redirect()->route('customer.view')->with('success', 'Customer Updated Successfully');
    }
     //---- Customer Delete ----//
    public function delete($id){
        // Delete
        $customerDelete = customer::find($id);
        $customerDelete->delete();
        // Redirect 
      return redirect()->route('customer.view')->with('error', 'Customer Deleted Successfully');
    }
    //---- Customer Credit ----//
    public function customerCredit(){
        $customersCredit = payment::whereIn('paid_status', ['full_due','partical_paid'])->get();
        // dd($customersCredit->toArray());
        return view('layouts.Backend.customers.customerCredit', compact('customersCredit'));
    }
    //---- Customer Credit PDF ----//
    public function customerCreditPdf(){
        $data['customersCredit'] = payment::whereIn('paid_status', ['full_due', 'partical_paid'])->get();
        $pdf = PDF::loadView('layouts.Backend.pdf.customerCredit', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //---- Customer Credit Edit ----//
    public function customerCreditEdit($invoice_id){
        $data['payment'] = payment::where('invoice_id', $invoice_id)->first();
        $data['invoice_details'] = invoiceDetail::where('invoice_id', $invoice_id)->get();
          //dd($data->toArray());
       return view('layouts.Backend.customers.customerCreditEdit', $data);
    }
    //---- Customer Credit Update ----//
    public function customerCreditUpdate(Request $request, $invoice_id){
       //validation 
        $validation = $request->validate([
            'paid_status' => 'required',
            'date' => 'required'
        ]);
        // partials paid validation
        if($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error','Error! Please Paid Exact Amount');
        } else{
            $payment = payment::where('invoice_id', $invoice_id)->first();
            $paymentDetails = new paymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid') {
                $payment->paid_amount = payment::where('invoice_id', $invoice_id)->first()->paid_amount + $request->new_paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->new_paid_amount;
            } elseif($request->paid_status == 'Partical_paid'){
                $payment->paid_amount = payment::where('invoice_id', $invoice_id)->first()->paid_amount + $request->paid_amount;
                $payment->due_amount = $request->new_paid_amount - $request->paid_amount;
                $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $paymentDetails->invoice_id = $invoice_id;
            $paymentDetails->date = date('Y-m-d', strtotime($request->date));
            $paymentDetails->updated_by = Auth::user()->id;
            $paymentDetails->save();
            // Redirect
             return redirect()->route('customer.credit')->with('success', 'Customer Credit Edit Successfully');
        }
    }
    //---- Indivisual Customer Credit Summery ----//
    public function customerCreditSummery($invoice_id){
        $data['payment'] = payment::where('invoice_id', $invoice_id)->first();
        $data['invoice_details'] = invoiceDetail::where('invoice_id', $invoice_id)->get();
        $data['payment_details'] = paymentDetail::where('invoice_id', $invoice_id)->get();
        $pdf = PDF::loadView('layouts.Backend.pdf.customerCreditSummery', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //---- Paid Customer List ----//
    public function customerPaidList(){
        $customersCredit = payment::whereIn('paid_status', ['full_paid', 'partical_paid'])->get();
        //$customersCredit = payment::where('paid_status', '!=', 'full_due')->get();
        //dd($data->toArray());
        return view('layouts.Backend.customers.customerPaidList', compact('customersCredit'));
    }
    //---- Paid Customer List PDF ----//
    public function customerPaidListPdf(){
        $data['payments'] = payment::where('paid_status', '!=', 'full_due')->get();
        $pdf = PDF::loadView('layouts.Backend.pdf.customerPaidPdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //---- Customer Wais Report ---//
    public function customerWaisReport(){
        $data['customers'] = customer::all();
        return view('layouts.Backend.customers.customerWaisReport', $data);
    }
    //---- Customer Credit Wais PDF ----//
    public function customerCreditWaisPdf(Request $request){
        $customer_id = $request->customer_id;
        $data['creditCustomer'] = payment::whereIn('paid_status',['full_due', 'partical_paid'])->where('customer_id', $customer_id)->get();
        $pdf = PDF::loadView('layouts.Backend.pdf.singleCustomerCreditPdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //---- Customer Paid wais PDF ----//
    public function customerPaidWaisPdf(Request $request){
        $customer_id = $request->customer_id;
        $data['paidCustomer'] = payment::whereIn('paid_status',['full_paid', 'partical_paid'])->where('customer_id', $customer_id)->get();
        $pdf = PDF::loadView('layouts.Backend.pdf.singleCustomerPaidPdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
