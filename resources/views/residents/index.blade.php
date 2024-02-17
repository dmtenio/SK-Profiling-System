@extends('layouts.app')

@section('page-title', 'Youths')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">List of Youths</h5>
                    <a href="{{ route('residents.create') }}" class="btn btn-primary btn-sm float-end">
                        <i class="bi bi-plus-lg"></i>
                        Add Youth
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="residentstable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Civil Status</th>
                                    <th>Home Address</th>
                                    <th style="width:5%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Civil Status</th>
                                    <th>Home Address</th>
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
        $('#residentstable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('residents.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'age', name: 'age'},
                {data: 'gender', name: 'gender'}, 
                {data: 'civil_status', name: 'civil_status'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            createdRow: function(row, data, dataIndex) {
                // Get the age value from the data
                var age = parseInt(data.age);
                // Check if age is greater than 30
                if (age > 30) {
                    $(row).addClass('bg-danger text-white');
                }
            }
        });
        
    });

</script>
@endpush
