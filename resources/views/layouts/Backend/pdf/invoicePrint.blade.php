<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
<h2 style="text-align:center; color: #4e73df; padding-bottom: 5px; margin-left: 20px;" class="text-primary">
	<strong>Shop Name:- Codding Solve BD</strong>
</h2>
<table width="100%" class="table" style="text-align: center;">
    <tbody class="text-center">
			<tr>
			   <td>
				 <h4 class="text-dark"><strong>Invoice No:- {{ $invoice->invoice_no }}</strong></h4>
			    </td>
			    <td>
				 <h5 class="text-dark">
				  <strong>Shop Owner Mobile:- 01871848137</strong></h5>
			    </td>
			    <td>
				<h5 class="text-dark">
					<strong>Shop Mobile:- 01871848137</strong>
				</h5>
			    </td>
		</tr>
	</tbody>
</table>
<hr>
<table width="100%">
	<tbody>
		<tr>
			<td width="100%" style="text-align: center; color: black;  padding: 10px 0px; font-size: 20px;"><h4><strong>Customer Information:-</strong></h4></td>
		</tr>
	</tbody>
</table>
<table width="100%">
	<tbody>
	  <tr>
	  <td>	
		<h5 class="text-dark">
		 <strong>Name:- {{ $invoice->payment->customer->name }} </strong>
		</h5>
	  </td>
		<td><h5 class="text-dark">
		 <strong>Mobile:- {{ $invoice->payment->customer->mobile }}</strong>
		</h5>
	    </td>
		<td><h5 class="text-dark">
		 <strong>Email:- {{ $invoice->payment->customer->email }}</strong>
		</h5>
	    </td>
		<td><h5 class="text-dark">
		 <strong>Address:- {{ $invoice->payment->customer->address }}</strong>
		</h5>
	    </td>
	  </tr>
	</tbody>
</table>
<hr>
<table width="100%" border="1" style="text-align: center;">
	<thead style="background:#cdced2;">
        <tr>
           <th>SL NO.</th>
           <th>Category Name</th>
           <th>Product Name</th>
           <th>Quantity</th>
           <th>Unit Price</th>
           <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
    	@php 
    	$subTotal = '0';
    	@endphp
    @foreach($invoice->invoiceDetails as $key => $invoiceDetal)
      <tr>
    	<td>{{ $key+1 }}</td>
    	<td>{{ $invoiceDetal->category->name }}</td>
    	<td>{{ $invoiceDetal->product->name }}</td>
    	<td>{{ $invoiceDetal->selling_qty }}</td>
    	<td>{{ $invoiceDetal->unit_price }}</td>
    	<td>{{ $invoiceDetal->selling_price }}</td>
      </tr>
      @php
      $subTotal += $invoiceDetal->selling_price;
      @endphp
    @endforeach
    <tr>
    	<td colspan="5" style="text-align: right;">Sub Total:-</td>
    	<td>{{ $subTotal }}</td>
    </tr>
    <tr>
    	<td colspan="5" style="text-align: right;">Discount Amount:-</td>
    	<td>{{ $invoice->payment->discount_amount }}</td>
    </tr>
    <tr>
    	<td colspan="5" style="text-align: right;">Paid Amount:-</td>
    	<td>{{ $invoice->payment->paid_amount }}</td>
    </tr>
    <tr>
    	<td colspan="5" style="text-align: right;">Due Amount:-</td>
    	<td>{{ $invoice->payment->due_amount }}</td>
    </tr>
    <tr>
    	<td colspan="5" style="text-align: right;">Grant Total:-</td>
    	<td>{{ $invoice->payment->total_amount }}</td>
    </tr>
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
			<td style="text-align: left;">Customer Signature</td>
			<td style="text-align: right;">Saller Signature</td>
		</tr>
	</tbody>
</table>
</body>
</html>