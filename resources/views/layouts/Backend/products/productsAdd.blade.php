@extends('layouts.Backend.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                  <a class="btn btn-info py-2 my-3" href="{{ route('products.view') }}">View Products
                  </a>
                  <!---- From start ---->
                  <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <!---- From Two Colum Start ---->
                                  <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Company Name</label>
                                          <select name="supplier_id" class="form-control select2">
                                            <option value="">
                                            *Select Company*
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
                                 <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Product Unit</label>
                                          <select name="unit_id" class="form-control select2">
                                            <option value="">
                                            *Select Unit*
                                            </option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">
                                              {{ $unit->name }}
                                            </option>
                                            @endforeach
                                          </select>
                                           @error('unit_id')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                       </div> 
                                  </div>
                        <!---- From Two Colum Start ---->

                        <!---- From Two Colum Start ---->
                                  <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Product Category</label>
                                          <select name="category_id" class="form-control select2">
                                            <option value="">
                                            *Select Categories*
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
                                  <div class="col-lg-6">
                                        <div class="form-group">
                                          <label>Product Name</label>
                                           <input type="text" name="name" class="form-control @error('name') Invalid @enderror form-control-sm">
                                           @error('name')
                                           <strong class="alert alert-danger">{{ $message }}
                                           </strong>
                                          @enderror
                                       </div> 
                                  </div>
                        <!---- From Two Colum Start ---->
                    </div><!--End row -->
                      <!-- Submit Button start -->
                      <div class="form-group">
                         <input type="submit" name="submit" class="form-control btn btn-info btn-block">
                      </div>
                     <!-- Submit Button end -->  
                  </form>
                  <!---- From start ----> 
            </div>
       </div>          
    </div>
</div>
@endsection