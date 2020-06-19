@extends('layouts.Backend.master')
@push('css')
<link href="{{ asset('assets/Backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Invoice Pending List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Customer Name</th>
                      <th>Invoice No.</th>
                      <th>Date</th>
                      <th>Description</th> 
                      <th>Total Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($invoicePending as $key => $invoicePendin)
                     <tr>
                       <td>{{ $key+1 }}</td>
                       <td>
                        {{ $invoicePendin['payment']['customer']['name'] }}
                        ( {{ $invoicePendin['payment']['customer']['mobile'] }} )
                       </td>
                       <td> Invoice No #{{ $invoicePendin->invoice_no }}</td>
                       <td>{{ date('d-m-Y', strtotime($invoicePendin->date)) }}</td>
                       <td>{{ $invoicePendin->description }}</td>
                       <td>{{ $invoicePendin->payment->total_amount }}</td>
                       <td>
                         <span class="btn btn-danger">{{ ($invoicePendin->status == '0')?'pending':'approved' }}</span>
                       </td>
                       <td>
                       <a onclick="return confirm('Are you sure To Approved This Invoice')" href="{{ route('invoice.approve', $invoicePendin->id) }}" class="btn btn-success">Approve</a>
                        <a onclick="return confirm('are you suer to delete Invoice')" title="Delete" class="btn btn-danger" href="{{ route('invoice.delete', $invoicePendin->id) }}"><i class="fa fa-trash"></i></a>
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
