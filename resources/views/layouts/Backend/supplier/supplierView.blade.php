@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
 <!-- Page Heading -->
          <a class="btn btn-success my-3" href="{{ route('supplier.add') }}"><i class="fa fa-plus-circle"></i>Add Supplier</a>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Supplier Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($suppliers as $key => $supplier)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $supplier->name }}</td>
                      <td>{{ $supplier->mobile }}</td>
                      <td>{{ $supplier->email }}</td>
                      <td>{{ $supplier->address }}</td>
                      @php
                      $supplierCount = App\Model\product::where('supplier_id', $supplier->id)->count();
                      @endphp
                      <td>
                      	<a title="Edit" class="btn btn-success" href="{{ route('supplier.edit', $supplier->id) }}"><i class="fa fa-edit"></i></a>
                        @if($supplierCount<1)
                      	<a onclick="return confirm('are you suer to delete User')" title="Delete" class="btn btn-danger" href="{{ route('supplier.delete', $supplier->id) }}"><i class="fa fa-trash"></i></a>
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
