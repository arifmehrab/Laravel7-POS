@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
 <!-- Page Heading -->
          <a class="btn btn-success my-3" href="{{ route('users.add') }}"><i class="fa fa-plus-circle"></i>Add Employee</a>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Employees List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Role</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Number</th>
                      <th>Shop Name</th>
                      <th>Address</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($users as $key => $user)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $user->userRole }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->number }}</td>
                      <td>{{ $user->shopName }}</td>
                      <td>{{ $user->address }}</td>
                      <td>
                      	<img width="50" src="{{ asset('assets/Backend/images/'.$user->profile) }}">
                      </td>
                      <td>
                      	<a title="Edit" class="btn btn-success" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                      	<a onclick="return confirm('are you suer to delete User')" title="Delete" class="btn btn-danger" href="{{ route('users.delete', $user->id) }}"><i class="fa fa-trash"></i></a>
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
