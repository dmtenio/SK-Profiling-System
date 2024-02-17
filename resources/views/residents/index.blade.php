@extends('layouts.app')

@section('page-title', 'Users')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">List of Users</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end">
                        <i class="bi bi-plus-lg"></i>
                        Add User
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userstable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Barangay</th>
                                    <th>Account Type</th>
                                    <th>Status</th>
                                    <th style="width:5%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Barangay</th>
                                    <th>Account Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('page-scripts')
<!-- Page specific script -->
<script>
 

    $(document).ready(function () {
          $('#userstable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('users.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'position', name: 'position.name'}, 
                    {data: 'barangay', name: 'barangay.name'},
                    {data: 'account_type', name: 'account_type'},
                    {data: 'status', name: 'status'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
              }
            );
       
      });


</script>
@endpush
