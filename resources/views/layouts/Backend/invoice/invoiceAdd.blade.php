@extends('layouts.Backend.master')
@push('ajax')
<!-- Extra HTML for If exist Event -->
  <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="date" value="@{{date}}">
      <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
      </td>
      <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
      </td>
      <td>
        <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]"  value="1">
      </td> 
      <td>
        <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]"  value="">
      </td>
      <td>
        <input class="form-control form-control-sm text-right selling_price" name="selling_price[]"  value="0" readonly>
      </td>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>
  </script>
<script type="text/javascript">
  $(document).ready(function(){
     $(document).on('click','.addMore', function(){
        var date = $('#date').val();
        var invoice_no = $('#invoice_no').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id    = $('#product_id').val();
        var product_name  = $('#product_id').find('option:selected').text();
         // validation
        if(date==''){
          $.notify("Date is required", {globalPosition: 'top right',className: 'error'});
          return false;
        }
        if(category_id==''){
          $.notify("Category no is required", {globalPosition: 'top right',className: 'error'});
          return false;
        }
        if(product_id==''){
          $.notify("Product no is required", {globalPosition: 'top right',className: 'error'});
          return false;
        }
        var source   = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data     = {
          date:date,
          invoice_no:invoice_no,
          category_id:category_id,
          category_name:category_name,
          product_id:product_id,
          product_name:product_name
        };
        var html = template(data);
        $('#addRow').append(html);
         });
        // Remove Handlebar
        $(document).on('click', '.removeeventmore', function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });
        // Handlebar Multificaion
        $(document).on('keyup click', '.unit_price,.selling_qty', function(){
           var unit_price = $(this).closest("tr").find("input.unit_price").val();
           var selling_qty = $(this).closest("tr").find("input.selling_qty").val();
           var total = unit_price*selling_qty;
           $(this).closest("tr").find("input.selling_price").val(total);
           // Discount 
           $('#discount_amount').trigger('keyup');   
        });
        // Discount Script
        $(document).on('keyup','#discount_amount', function(){
          totalAmountPrice();
        });
        //calculate sum of amount in invoice
        function totalAmountPrice(){
          var sum = 0;
          // sum
          $('.selling_price').each(function(){
             var value = $(this).val();
             if(!isNaN(value) && value.length != 0) {
             sum += parseFloat(value);             
          }
          });
        // Discount
        var discount_amount = parseFloat($('#discount_amount').val());
        if(!isNaN(discount_amount) && discount_amount.length != 0) {
          sum -= parseFloat(discount_amount);
        }
          $('#estimated_amount').val(sum);
      }
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '#category_id', function(){
       var category_id = $(this).val();
       $.ajax({
        url : "{{ route('get.invoice.category') }}",
        type: "GET",
        data: {category_id,category_id},
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data, function(key,v){
            html+='<option value="'+v.id+'">'+v.name+'</option>';
          });
          $('#product_id').html(html);
        }
       });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#product_id', function(){
       var product_id = $(this).val();
       $.ajax({
        url: "{{ route('get.product.quantity') }}",
        type: "GET",
        data: {product_id,product_id},
        success:function(data){
          $('#stock').val(data);
        }
       });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    // Paid Status //
     $(document).on('change','#paid_status', function(){
        var paid_status = $(this).val();
        if(paid_status == 'Partical_paid') {
           $('.paid_amount').show();
        } else{
          $('.paid_amount').hide();
        }
     });
     // New Customer //
     $(document).on('change','#customer', function(){
        var customer = $(this).val();
        if(customer == '0') {
          $('.newCustomer').show();
        } else{
          $('.newCustomer').hide();
        }
     });
  });
</script>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                  <a class="btn btn-info py-2 mb-4" href="{{ route('invoice.view') }}">View Invoice
                  </a>
                  <!---- From start ---->
                      <div class="row">
                        <!---- From Colum Start ---->
                                  <div class="col-lg-1">
                                      <div class="form-group">
                                        <label>Invoice N.</label>
                                        <input type="text" name="invoice_no" id="invoice_no" class="form-control form-control-sm" readonly style="background-color: #D8FDBA;" value="{{ $invoiceData }}">
                                      </div> 
                                  </div>

                                  <div class="col-lg-2">
                                      <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date" id="date" class="form-control form-control-sm">
                                      </div> 
                                  </div>

                                  <div class="col-lg-3">
                                       <div class="form-group">
                                          <label>Category Name</label>
                                          <select name="category_id" class="form-control select2" id="category_id">
                                            <option value="">
                                            *Select Category*
                                            </option>
                                           @foreach($categories as $category)
                                            <option value="{{ $category->id }}">
                                              {{ $category->name }}
                                            </option>
                                            @endforeach
                                          </select>
                                           @error('category_id')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                       </div> 
                                  </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Product</label>
                                        <select name="product_id" class="form-control select2" id="product_id">
                                        <option value="">
                                            *Select Product* 
                                        </select>   
                                    </div> 
                                </div>

                                <div class="col-lg-2">
                                  <div class="form-group">
                                    <label>Stock(pcs/kg)</label>
                                    <input type="text" name="stock" id="stock" class="form-control form-control-sm" readonly style="background-color: #D8FDBA;">
                                  </div> 
                                </div>

                                <div class="col-lg-1">
                                  <div class="form-group">
                                    <a name="addMore" id="addMore" class="btn btn-primary mt-4 text-white addMore">
                                      ADD
                                    </a>
                                  </div> 
                                </div>

                    </div><!--End row -->
            </div>
       </div> 
       <!------ Show Purchase Filed Value start ------>
        <div class="card my-4">
          <div class="card-body">
            <form method="post" action="{{ route('invoice.store') }}" id="myForm">
               @csrf
               <table class="table-sm table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th width="7%">Pcs/Kg</th>
                        <th width="10%">Unit Price</th>
                        <th width="17%">Total Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">
                      
                    </tbody>
                    <tbody>
                      <tr>
                        <td colspan="4">Discount Amount</td>
                        <td>
                          <input type="number" name="discount_amount" id="discount_amount" class="form-control" placeholder="Write Discount Amount">
                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td colspan="4"></td>
                        <td>
                          <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                <!---- Description Field start ---->
                <div class="form-row">
                  <div class="col-lg-12">
                    <textarea class="form-control" rows="3" placeholder="Write Something About Invoice" name="description" id="description"></textarea>
                  </div>
                </div>
                <!---- Description Field End ---->
                <br>
                <!---- Three Colum Field start ---->
                <div class="form-row">
                  <!-- Paind Status Filed Start -->
                  <div class="col-lg-5">
                   <div class="form-group">
                     <label><strong>Paid Status</strong></label>
                     <select name="paid_status" class="form-control form-control-sm" id="paid_status">
                       <option value="">*Select Paid status*</option>
                       <option value="full_paid">Full Paid</option>
                       <option value="full_due">Full Due</option>
                       <option id="Partical_paid" value="Partical_paid">Partical Paid</option>
                     </select>
                     <!--- After Partical Paid --->
                     <br>
                     <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Write Partical Amount" style="display: none;"> 
                   </div>
                  </div>
                  <!-- Paind Status Filed Start -->

                 <!-- Customer Filed Start -->
                  <div class="col-lg-7">
                   <div class="form-group">
                     <label><strong>Select Customer</strong></label>
                     <select name="customer" class="form-control select2" id="customer">
                       <option value="">*Select Customer*</option>
                       @foreach($customers as $customer)
                       <option value="{{ $customer->id }}">
                         {{ $customer->name }} | {{ $customer->mobile }} | {{ $customer->address }}
                       </option>
                       @endforeach
                       <option value="0">New Customer</option>
                     </select>
                     <!--- After New Customer Start --->
                     <br><br>
                     <div class="newCustomer" style="display: none;">
                      <strong>New Customer Information Field</strong>
                       <input type="text" name="name" class="form-control" placeholder="Write Customer Name">
                       <br>
                       <input type="number" name="mobile" class="form-control" placeholder="Write Customer Mobile">
                       <br>
                       <input type="email" name="email" class="form-control" placeholder="Write Customer Email">
                       <br>
                       <input type="text" name="address" class="form-control" placeholder="Write Customer Adddress">
                     </div>
                     <!--- After New Customer End ---> 
                   </div>
                  </div>
                 <!-- Customer Filed End -->
                </div><!-- end row -->
                <!---- Three Colum End ---->

                <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="storeButton">Invoice Store</button>
                  </div>
            </form>
          </div>
        </div>
       <!------ Show Purchase Filed Value start ------>         
    </div>
</div>
@endsection
