@extends('layouts.Backend.master')
@push('ajax')
<script type="text/javascript">
  $(document).ready(function(){
     $(document).on('change', '.serch_value', function(){
        var value = $(this).val();
        // credit customer
        if(value == 'credit_customer') {
          $('#credit_customer').show();
        } else{
          $('#credit_customer').hide();
        } 
       // paid customer
       if(value == 'paid_customer'){
        $('#paid_customer').show();
       } else{
        $('#paid_customer').hide();
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
                  <h4 class="py-2 mb-4 text-primary text-center">Search Customer Credit Or Paid Wais Report!
                  </h4>
                  <!--- Radio Button --->
                  <div class="row">
                    <div class="col-lg-8 offset-lg-4">
                      <label>
                        <strong>Credit Customer Report</strong>
                      </label>
                      <input type="radio" name="customer_wais_report" value="credit_customer" class="serch_value">
                      &nbsp; &nbsp;

                      <label>
                        <strong>Paid Customer Report</strong>
                      </label>
                      <input type="radio" name="customer_wais_report" value="paid_customer" class="serch_value">
                    </div>
                  </div>
              <!---- Credit Customer wais Report start ---->
                <div id="credit_customer" style="margin-top: 25px; display: none;">
                  <form method="GET" action="{{ route('customer.credit.wais.pdf') }}" target="_blank">
                    <div class="form-row">
                      <div class="col-lg-7 offset-lg-2">
                        <div class="form-group">
                            <label>Credit Customer</label>
                            <select name="customer_id" class="form-control">
                              <option value="">
                              *Select Credit Customer*
                              </option>
                              @foreach($customers as $customer)
                              <option value="{{ $customer->id }}">
                                {{ $customer->name }} :-
                                {{ $customer->mobile }}
                              </option>
                              @endforeach
                           </select>
                             @error('customer_id')
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
              <!---- Credit Customer wais Report End ---->

              <!---- paid customer report start ---->
               <div id="paid_customer" style="margin-top: 25px; display: none;">
                  <form method="GET" action="{{ route('customer.paid.wais.pdf') }}" target="_blank">
                    <div class="form-row">
                      <div class="col-lg-7 offset-lg-2">
                        <div class="form-group">
                            <label>Paid Customer</label>
                            <select name="customer_id" class="form-control" id="customer_id">
                              <option value="">
                              *Select Paid Customer*
                              </option>
                              @foreach($customers as $customer)
                              <option value="{{ $customer->id }}">
                                {{ $customer->name }} :-
                                {{ $customer->mobile }}
                              </option>
                              @endforeach
                           </select>
                             @error('customer_id')
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
              <!---- paid customer wais report end   ---->
            </div><!-- card body -->
       </div>        
    </div>
</div>
@endsection
