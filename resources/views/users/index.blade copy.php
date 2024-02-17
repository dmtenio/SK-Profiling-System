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
                        <table id="example" class="table table-striped" style="width:100%">
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
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->position->name}}</td>
                                    <td>{{ $user->barangay->name }}</td>
                                    {{-- <td>{{ $user->account_type}}</td> --}}
                                    <td>
                                        @if ($user->account_type === 'barangay_user')
                                            Barangay {{ $user->barangay->name }} User
                                        @elseif ($user->account_type === 'barangay_admin') 
                                            Barangay {{ $user->barangay->name }} Admin
                                        @elseif ($user->account_type === 'municipal_admin') 
                                            Municipal Admin
                                        @elseif ($user->account_type === 'provincial_admin') 
                                            Provincial Admin
                                        @elseif ($user->account_type === 'super_admin') 
                                            Super Admin
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Group">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm float-start">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- Button trigger delete modal -->
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$user->id}}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>

                                        <!-- Modal for delete -->
                                        <div class="modal fade" id="modelIdDelete-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                Are you sure to delete User: <strong>{{$user->name}}</strong> ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
        $('#example').DataTable();
    });
</script>
@endpush
