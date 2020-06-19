@extends('layouts.Backend.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                  <a class="btn btn-info py-2 my-3" href="{{ route('category.view') }}">View Categories
                  </a>
                  <!---- From start ---->
                  <form class="form" action="{{ route('category.update', $categoriesEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <!---- From Two Colum Start ---->
                                  <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Category Name</label>
                                           <input type="text" name="name" class="form-control @error('name') Invalid @enderror" value="{{ $categoriesEdit->name }}">
                                           @error('name')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                       </div> 
                                    <!-- Submit Button start -->
                                      <div class="form-group">
                                           <input type="submit" name="submit" class="form-control btn btn-success">
                                        </div>
                                    <!-- Submit Button end -->  
                                    </div>
                        <!---- From Two Colum Start ---->
                    </div><!--End row -->
                  </form>
                  <!---- From start ----> 
            </div>
       </div>          
    </div>
</div>
@endsection