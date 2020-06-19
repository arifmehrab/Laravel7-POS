@extends('layouts.Backend.master')
@push('ajax')
<script type="text/javascript">
  $(document).ready(function(){
     $(document).on('change','#category_id', function(){
        var category_id = $(this).val();
        $.ajax({
           url:"{{ route('get.product.wais.report') }}",
           type: "GET",
           data: { category_id,category_id },
           success:function(data){
            var html = '<option>Select Product</option>';
            $.each(data, function(key,v){
              html+= '<option value="'+v.id+'">'+v.name+'</option>';
            });
            $('#product_id').html(html);
           }
        });
     });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    // supplier wais //
    $(document).on('change','.serch_value', function(){
      var serchValue = $(this).val();
      if(serchValue == 'supplier_wais'){
        $('#supplier').show();
      } else{
        $('#supplier').hide();
      }
      // product wais //
      if(serchValue == 'product_wais') {
        $('#product').show();
       } else{
        $('#product').hide();
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
                  <h4 class="py-2 mb-4 text-primary text-center">Search Stock By Supplier And Product Wais!
                  </h4>
                  <!--- Radio Button --->
                  <div class="row">
                    <div class="col-lg-8 offset-lg-4">
                      <label>
                        <strong>Supplier Wais</strong>
                      </label>
                      <input type="radio" name="supplier_product_wais" value="supplier_wais" class="serch_value">
                      &nbsp; &nbsp;

                      <label>
                        <strong>Product Wais</strong>
                      </label>
                      <input type="radio" name="supplier_product_wais" value="product_wais" class="serch_value">
                    </div>
                  </div>
              <!---- supplier wais Report start ---->
                <div id="supplier" style="margin-top: 25px; display: none;">
                  <form method="GET" action="{{ route('stock.supplier.product.report.pdf') }}" target="_blank">
                    <div class="form-row">
                      <div class="col-lg-7 offset-lg-2">
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <select name="supplier_id" class="form-control">
                              <option value="">
                              *Select Supplier*
                              </option>
                              @foreach($suppliers as $supplier)
                              <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                              </option>
                              @endforeach
                           </select>
                             @error('supplier_id')
                             <strong class="alert alert-danger">{{ $message }}
                             </strong>
                             @enderror
                        </div> 
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <input style="padding-top: 10px;" type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                        </div> 
                      </div>
                    </div>
                  </form>
                </div>
              <!---- supplier wais Report End ---->
              <!---- Product wais report start ---->
               <div id="product" style="margin-top: 25px; display: none;">
                  <form method="GET" action="{{ route('stock.product.wais.pdf') }}" target="_blank">
                    <div class="form-row">
                      <div class="col-lg-5">
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control" id="category_id">
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
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label>Select Product</label>
                          <select name="product_id" class="form-control" id="product_id">
                             <option>Select Product</option>
                          </select>
                            @error('product_id')
                             <strong class="alert alert-danger">{{ $message }}
                             </strong>
                             @enderror
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <input style="padding-top: 10px;" type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                        </div> 
                      </div>
                    </div>
                  </form>
                </div>
              <!---- Product wais report end   ---->
            </div><!-- card body -->
       </div>        
    </div>
</div>
@endsection
