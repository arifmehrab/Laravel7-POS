@extends('layouts.Backend.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                  <h4 class="py-2 mb-4 text-primary">Search Invoice With Date Wais!
                  </h4>
                  <!---- From start ---->
                  <form target="_blank" method="GET" action="{{ route('invoice.daily.print') }}">
                      <div class="row">
                        <!---- From Colum Start ---->
                            
                                  <div class="col-lg-5">
                                      <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                        @error('start_date')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                      </div> 
                                  </div>

                                   <div class="col-lg-5">
                                      <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                                        @error('end_date')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                      </div> 
                                  </div>

                                  <div class="col-lg-2">
                                    <input type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                                  </div>
                           
                    </div><!--End row -->
                  </form>
            </div>
       </div>        
    </div>
</div>
@endsection
