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
	  <strong>Product name:- {{ $product['name'] }} </strong>
	</h3>
	<table border="1" width="100%" style="text-align: center;">
		<thead>
			<tr>
               <th>Product Category</th>
               <th>Product Name</th>
               <th>Product Stock</th>
            </tr>
		</thead>
	    <tbody>
            <tr>
                <td>{{ $product['category']['name'] }}</td>
                <td>{{ $product->name }}</td>
                <td>
                {{ $product->quantity }}
                {{ $product['unit']['name'] }}
                </td>
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
			<td style="text-align: left;">Shop Signature</td>
			<td style="text-align: right;">Owner Signature</td>
		</tr>
	</tbody>
</table>
</body>
</html>