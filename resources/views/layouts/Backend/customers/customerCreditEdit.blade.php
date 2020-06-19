@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('ajax')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#paid_status', function(){
       var paid_status = $(this).val();
       if(paid_status == 'Partical_paid') {
        $('.paid_amount').show();
       } else{
        $('.paid_amount').hide();
       }
    });
  });
</script>
@endpush

@section('content')
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-dark">Customer Credit Information:-</h4>
            </div>
            <div class="card-body">
             <form method="post" action="{{ route('customer.credit.update', $payment->invoice_id) }}">
              @csrf
                <!--- Customer Info start ---->
              <table class="table" style="color: black;">
                <tbody>
                  <tr>
                    <td><strong>Customer Information</strong></td>
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
                  <tr>
                    <td><strong>Description</strong></td>
                    <td colspan="3">{{ $payment->invoice->description }}</td>
                  </tr>
                </tbody>
              </table>
              <!--- Customer Info End ---->
              <!---- Selling info Start -->
              <table class="table borderd" style="background: #e2e2e2;  color: black;" width="100%">
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
                  <td colspan="5" class="text-right"><strong>Sub Total:</strong></td>
                  <td><strong>{{ $subTotal }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="5" class="text-right"><strong>Discount:</strong></td>
                  <td><strong>{{ $payment->discount_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="5" class="text-right"><strong>Paid Amount:</strong></td>
                  <td><strong>{{ $payment->paid_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                  <td colspan="5" class="text-right"><strong>Due Amount:</strong></td>
                  <td><strong>{{ $payment->due_amount }}</strong></td>
                </tr>
                <tr class="text-center">
                  <td colspan="5" class="text-right"><strong>Grant Total:</strong></td>
                  <td><strong>{{ $payment->total_amount }}</strong></td>
                </tr>
                </tbody>
              </table>
              <!---- Selling info End -->

               <!---- Three Colum Field start ---->
                <div class="form-row">
                  <!-- Paind Status Filed Start -->
                  <div class="col-lg-4">
                   <div class="form-group">
                     <label><strong>Paid Status</strong></label>
                     <select name="paid_status" class="form-control form-control-sm" id="paid_status">
                       <option value="">*Select Paid status*</option>
                       <option value="full_paid">Full Paid</option>
                       <option id="Partical_paid" value="Partical_paid">Partical Paid</option>
                     </select>
                     <!--- After Partical Paid --->
                     <br>
                     <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Write Partical Amount" style="display: none;"> 
                     @error('update_date')
                     <strong class="alert alert-danger">{{ $message }}</strong>
                     @enderror
                   </div>
                  </div>
                  <!-- Paind Status Filed Start -->

                 <!-- Customer Filed Start -->
                  <div class="col-lg-5">
                   <div class="form-group">
                     <label><strong>Select Date</strong></label>
                     <input type="date" name="date" class="form-control">
                     @error('date')
                     <strong class="alert alert-danger">{{ $message }}</strong>
                     @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <input type="submit" name="submit" value="Update" class="btn btn-primary" style="margin-top: 29px;">
                    </div>
                  </div>
                </div><!-- end row -->
                <!---- Three Colum End ---->
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
