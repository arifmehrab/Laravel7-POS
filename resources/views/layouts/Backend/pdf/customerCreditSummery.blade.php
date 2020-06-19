<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	<h2 style="text-align:center; color: #4e73df; padding-bottom: 5px; margin-left: 20px;" class="text-primary"><strong>Shop Name:- Codding Solve BD</strong></h2>
	<h5 style="text-align: center; color: black; padding-bottom: 0">
	  <strong>Shop Owner Mobile:- 01871848137</strong>
	</h5>
	<h5 style="text-align: center; color: black; padding-bottom: 0">
	  <strong>Shop Mobile:- 01827924326</strong>
	</h5>
    <hr style="padding-bottom: 0px;">
    <h4 style="color: black; padding-bottom: 0">
	  <strong>
	  	Customer Credit ALL Summery:-
	</strong>
	</h4>
    <!--- Customer Info start ---->
              <table width="100%" border="1" style="color: black;">
                <tbody>
                  <tr>
                    <td><strong>Customer Name: </strong>
                      {{ $payment->customer->name }}
                    </td>
                    <td><strong>Customer Mobile: </strong>
                      {{ $payment->customer->mobile }}
                    </td>
                    <td><strong>Customer Email: </strong>
                      {{ $payment->customer->email }}
                    </td>
                    <td><strong>Customer Adddress: </strong>
                      {{ $payment->customer->address }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <!--- Customer Info End ---->
              <br>
              <strong>
              	Invoice Details:-
              </strong>
              <br>
            <table width="100%" border="1" style="background: #e2e2e2;  color: black; text-align: center;">
               <thead style="background:#cdced2;">
                  @php
                  $subTotal = '0';
                  @endphp
                 <tr class="text-center">
                  <th>SL.</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                 </tr>
               </thead>
               <tbody>
                  @foreach($invoice_details as $key => $invoice_detail)
                  <tr class="text-center">
                    <th>{{ $key+1 }}</th>
                    <td>{{ $invoice_detail->category->name }}</td>
                    <td>{{ $invoice_detail->product->name }}</td>
                    <td>{{ $invoice_detail->selling_qty }}</td>
                    <td>{{ $invoice_detail->unit_price }}</td>
                    <td>{{ $invoice_detail->selling_price }}</td>
                  </tr>
                  @php
                  $subTotal += $invoice_detail->selling_price;
                  @endphp
                  @endforeach
                <tr class="text-center">
                  <td colspan="5" style="text-align: right;"><strong>Sub Total:</strong></td>
                  <td><strong>{{ $subTotal }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td style="text-align: right;" colspan="5" ><strong>Discount:</strong></td>
                  <td><strong>{{ $payment->discount_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td style="text-align: right;" colspan="5" ><strong>Paid Amount:</strong></td>
                  <td><strong>{{ $payment->paid_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td style="text-align: right;" colspan="5" ><strong>Due Amount:</strong></td>
                  <td><strong>{{ $payment->due_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td style="text-align: right;" colspan="5" ><strong>Grant Total:</strong></td>
                  <td><strong>{{ $payment->total_amount }}</strong></td>
                </tr>
               </tbody>
            </table>
            <br>
            <strong style="text-align: center; color:green;">
            	Customer Credit Summery Details:-
            </strong>
            <table width="100%" border="1" style="text-align: center;">
            	<thead>
            	    <tr>
            			<th>Date</th>
            			<th>Paid Amount</th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($payment_details as $payment_detail)
            		<tr>
                  <td>{{ date('d-m-Y', strtotime($payment_detail->date)) }}</td>
            			<td>{{ $payment_detail->current_paid_amount }}</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<br>
<strong>
	Printing Time:- {{ $date->format('F j, Y, g:i a') }}
</strong>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td style="text-align: left;">Shop Signature</td>
			<td style="text-align: right;">Owner Signature</td>
		</tr>
	</tbody>
</table>
</body>
</html>