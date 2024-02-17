@extends('layouts.app')

@section('page-title', 'Create User')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-header mb-3">

                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                placeholder="Input Name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="helpId" placeholder="Input Email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="helpId" placeholder="Input Password">
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select name="position_id" id="position" class="form-control select2">
                                <option value=""></option>
                                @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mb-3">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select name="account_type" id="account_type" class="form-control">
                                @if(auth()->user()->account_type === 'barangay_admin')
                                    <option value="barangay_user">Barangay User</option>
                                @elseif(auth()->user()->account_type === 'municipal_admin')
                                    <option value="barangay_user">Barangay User</option>
                                    <option value="barangay_admin">Barangay Admin</option>
                                @elseif(auth()->user()->account_type === 'provincial_admin')
                                    <option value="barangay_user">Barangay User</option>
                                    <option value="barangay_admin">Barangay Admin</option>
                                    <option value="municipal_admin">Municipal Admin</option>
                                @elseif(auth()->user()->account_type === 'super_admin')
                                    <option value="barangay_user">Barangay User</option>
                                    <option value="barangay_admin">Barangay Admin</option>
                                    <option value="municipal_admin">Municipal Admin</option>
                                    <option value="provincial_admin">Provincial Admin</option>
                                @endif
                            </select>
                        </div>
                        

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <div class="d-flex align-items-center">
                                <div id="avatarPreviewContainer" class="me-2 d-none">
                                    <img id="avatarPreview" src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" name="avatar" accept="image/*" class="form-control" id="avatar" onchange="previewAvatar(this)">
                                </div>
                                <div class="ms-2">
                                    <label for="avatar" class="btn btn-primary btn-sm" title="Upload new avatar"><i class="bi bi-upload"></i></label>
                                    <button type="button" class="btn btn-danger btn-sm" title="Remove avatar" onclick="removeAvatar()"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select name="barangay_id" id="barangay" class="form-control select2">
                                <option value=""></option>
                                @foreach ($barangays as $barangay)
                                    @if ($user->account_type === 'barangay_admin')
                                        <option value="{{ $barangay->id }}" {{ $user->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
                                    @else
                                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                                                

                        <div class="mb-3">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection

@push('page-scripts')

<script>
    $(document).ready(function() {
        // Initialize Select2 for position and campus dropdowns
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select an option'
        });
    });

    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatarPreview').attr('src', e.target.result);
                $('#avatarPreviewContainer').removeClass('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeAvatar() {
        $('#avatar').val('');
        $('#avatarPreviewContainer').addClass('d-none');
    }

    
    
</script>

@endpush
