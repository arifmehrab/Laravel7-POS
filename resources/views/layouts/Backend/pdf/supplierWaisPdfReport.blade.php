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
    <h3 style="color: black; padding-bottom: 0">
	  <strong>Supplier name:- {{ $suppliers['0']['supplier']['name'] }} </strong>
	</h3>
	<table border="1" width="100%" style="text-align: center;">
		<thead>
			<tr>
               <th>SL.</th>
               <th>Product Category</th>
               <th>Product Name</th>
               <th>Product Stock</th>
            </tr>
		</thead>
	    <tbody>
            @foreach($suppliers as $key => $supplier)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $supplier['category']['name'] }}</td>
                <td>{{ $supplier->name }}</td>
                <td>
                {{ $supplier->quantity }}
                {{ $supplier['unit']['name'] }}
                </td>
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