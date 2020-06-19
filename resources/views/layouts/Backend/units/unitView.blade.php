@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
 <!-- Page Heading -->
          <a class="btn btn-success my-3" href="{{ route('unit.add') }}"><i class="fa fa-plus-circle"></i>Add unite</a>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Units List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                 @foreach($units as $key => $unit)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $unit->name }}</td>
                      @php
                      $unitCount = App\Model\product::where('unit_id', $unit->id )->count();
                      @endphp
                      <td>
                      	<a title="Edit" class="btn btn-success" href="{{ route('unit.edit', $unit->id) }}"><i class="fa fa-edit"></i></a>
                        @if($unitCount<1)
                      	<a onclick="return confirm('are you suer to delete User')" title="Delete" class="btn btn-danger" href="{{ route('unit.delete', $unit->id) }}"><i class="fa fa-trash"></i></a>
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
