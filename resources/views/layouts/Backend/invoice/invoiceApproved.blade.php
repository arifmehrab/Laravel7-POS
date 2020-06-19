@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-dark"> Invoice No: {{ $invoice->invoice_no }} ({{ date('d-m-Y', strtotime($invoice->date)) }}) </h4>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('invoice.approve.process', $invoice->id) }}">
                @csrf
              <!--- Customer Info start ---->
              <table class="table" style="color: black;">
                <tbody>
                  <tr>
                    <td><strong>Customer Information</strong></td>
                    <td><strong>Customer Name: </strong>
                      {{ $invoice->payment->customer->name }}
                    </td>
                    <td><strong>Customer Mobile: </strong>
                      {{ $invoice->payment->customer->mobile }}
                    </td>
                    <td><strong>Customer Email: </strong>
                      {{ $invoice->payment->customer->email }}
                    </td>
                    <td><strong>Customer Adddress: </strong>
                      {{ $invoice->payment->customer->address }}
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Description</strong></td>
                    <td colspan="3">{{ $invoice->description }}</td>
                  </tr>
                </tbody>
              </table>
              <!--- Customer Info End ---->
              <!---- Selling info Start -->
              <table class="table borderd" style="background: #e2e2e2;  color: black;" width="100%">
                <thead style="background:#cdced2;">
                 <tr class="text-center">
                  <th>SL NO.</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Current Quantity</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                 </tr>
                </thead>
                <tbody>
                  @php 
                  $subTotal = '0';
                  @endphp
                  @foreach($invoice['invoiceDetails'] as $key => $invoices)

                  <input type="hidden" name="category_id[]" value="invoices->category_id">

                  <input type="hidden" name="product_id[]" value="invoices->product_id">

                  <input type="hidden" name="selling_qty[{{ $invoices->id }}]" value="invoices->selling_qty">
                  <tr class="text-center">

                    <td>{{ $key+1 }}</td>
                    <td>{{ $invoices->category->name }}</td>
                    <td>{{ $invoices->product->name }}</td>
                    <td>{{ $invoices->product->quantity }}</td>
                    <td>{{ $invoices->selling_qty }}</td>
                    <td>{{ $invoices->unit_price }}</td>
                    <td>{{ $invoices->selling_price }}</td>
                  </tr>
                  @php
                  $subTotal += $invoices->selling_price;
                  @endphp
                @endforeach
                <tr class="text-center">
                  <td colspan="6" class="text-right"><strong>Sub Total:</strong></td>
                  <td><strong>{{ $subTotal }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="6" class="text-right"><strong>Discount:</strong></td>
                  <td><strong>{{ $invoice->payment->discount_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="6" class="text-right"><strong>Paid Amount:</strong></td>
                  <td><strong>{{ $invoice->payment->paid_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="6" class="text-right"><strong>Due Amount:</strong></td>
                  <td><strong>{{ $invoice->payment->due_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="6" class="text-right"><strong>Grant Total:</strong></td>
                  <td><strong>{{ $invoice->payment->total_amount }}</strong></td>
                </tr>
                </tbody>
              </table>
              <!---- Selling info End -->
              <input type="submit" name="submit" value="Invoice Approved" class="btn btn-primary">
              </form>
            </div>
          </div>
@endsection

@push('js')
<!-- Page level plugins -->
  <script src="{{ asset('assets/Backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/Backend/js/demo/datatables-demo.js') }}"></script>
@endpush
