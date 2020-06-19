@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
 <!-- Page Heading -->
          <a class="btn btn-success my-3" href="{{ route('products.add') }}"><i class="fa fa-plus-circle"></i>Add Product</a>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Supplier Name</th>
                      <th>Product Stock</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $key => $product)
                     <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $product['supplier']['name'] }}</td>
                       <td>
                        {{ $product->quantity }}
                        {{ $product['unit']['name'] }}
                       </td>
                       <td>{{ $product->category->name }}</td>
                       <td>{{ $product->name }}</td>
                       @php 
                       $productCount = App\Model\purchase::where('product_id', $product->id)->count();
                       @endphp
                       <td>
                        <a title="Edit" class="btn btn-success" href="{{ route('products.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
                        @if($productCount < 1)
                        <a onclick="return confirm('are you suer to delete User')" title="Delete" class="btn btn-danger" href="{{ route('products.delete', $product->id) }}"><i class="fa fa-trash"></i></a>
                        @endif
                      </td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
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
