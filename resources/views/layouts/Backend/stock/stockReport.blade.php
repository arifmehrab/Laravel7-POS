@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
 <!-- Page Heading -->
          <a target="_blank" class="btn btn-primary my-3" href="{{ route('stock.report.pdf') }}"><i class="fa fa-download"></i>Download Stock PDF</a>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products Stock List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Supplier Name</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>In (Stock)</th>
                      <th>Out (Stock)</th>
                      <th>Current Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $key => $product)
                     @php 
                     $purchase_stock = App\Model\purchase::where('category_id', $product->category_id)->where('product_id',$product->id)->where('status', '1')->sum('buying_qty');
                     $selling_stock  = App\Model\invoiceDetail::where('category_id',$product->category_id)->where('product_id', $product->id)->where('status', '1')->sum('selling_qty');
                     @endphp
                     <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $product['supplier']['name'] }}</td>
                       <td>{{ $product->category->name }}</td>
                       <td>{{ $product->name }}</td>
                       <td>
                        {{ $purchase_stock }}
                       {{ $product['unit']['name'] }}
                     </td>
                       <td>
                         {{ $selling_stock }}
                         {{ $product['unit']['name'] }}
                       </td>
                       <td>
                        {{ $product->quantity }}
                        {{ $product['unit']['name'] }}
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
