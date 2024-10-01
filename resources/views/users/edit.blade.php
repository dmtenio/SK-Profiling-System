@extends('layouts.app')

@section('page-title', 'Edit User')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Enter new password">
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select name="position_id" id="position" class="form-control">
                                <option value=""></option>
                                @foreach ($positions as $position)
                                <option value="{{ $position->id }}" @if($position->id === $user->position_id) selected @endif>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mb-3">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select name="account_type" id="account_type" class="form-control">
                                @if(auth()->user()->account_type === 'barangay_admin')
                                    <option value="barangay_user" @if($user->account_type === "barangay_user") selected @endif>Barangay User</option>
                                    <option value="barangay_admin" @if($user->account_type === "barangay_admin") selected @endif>Barangay Admin</option>
                                @elseif(auth()->user()->account_type === 'municipal_admin')
                                    <option value="barangay_user" @if($user->account_type === "barangay_user") selected @endif>Barangay User</option>
                                    <option value="barangay_admin" @if($user->account_type === "barangay_admin") selected @endif>Barangay Admin</option>
                                    <option value="municipal_admin" @if($user->account_type === "municipal_admin") selected @endif>Municipal Admin</option>
                                @elseif(auth()->user()->account_type === 'provincial_admin')
                                    <option value="barangay_user" @if($user->account_type === "barangay_user") selected @endif>Barangay User</option>
                                    <option value="barangay_admin" @if($user->account_type === "barangay_admin") selected @endif>Barangay Admin</option>
                                    <option value="municipal_admin" @if($user->account_type === "municipal_admin") selected @endif>Municipal Admin</option>
                                    <option value="provincial_admin" @if($user->account_type === "provincial_admin") selected @endif>Provincial Admin</option>
                                @elseif(auth()->user()->account_type === 'super_admin')
                                    <option value="barangay_user" @if($user->account_type === "barangay_user") selected @endif>Barangay User</option>
                                    <option value="barangay_admin" @if($user->account_type === "barangay_admin") selected @endif>Barangay Admin</option>
                                    <option value="municipal_admin" @if($user->account_type === "municipal_admin") selected @endif>Municipal Admin</option>
                                    <option value="provincial_admin" @if($user->account_type === "provincial_admin") selected @endif>Provincial Admin</option>
                                    <option value="super_admin" @if($user->account_type === "super_admin") selected @endif>Super Admin</option>
                                @endif
                            </select>
                        </div>
                        


                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select name="barangay_id" id="barangay" class="form-control">
                                <option value=""></option>
                                @foreach ($barangays as $barangay)
                                <option value="{{ $barangay->id }}" @if($barangay->id === $user->barangay_id) selected @endif>{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <!-- <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" @if($user->status === 'active') selected @endif>Active</option>
                                    <option value="inactive" @if($user->status === 'inactive') selected @endif>Inactive</option>
                                </select>
                            </div> -->
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1" @if($user->is_active) selected @endif>Active</option>
                                <option value="0" @if(!$user->is_active) selected @endif>Inactive</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <div class="d-flex align-items-center">
                                <div id="avatarPreviewContainer" class="me-2">
                                    <img id="avatarPreview" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
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
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
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
        // Initialize Select2 for position
        $('#position').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: "Select a position"
        });

        // Initialize Select2 for barangay
        $('#barangay').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: "Select a barangay"
        });
    });

    // Function to preview avatar image
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

    // Function to remove avatar image
    function removeAvatar() {
        $('#avatar').val('');
        $('#avatarPreviewContainer').addClass('d-none');
        $('#avatarPreview').attr('src', '{{ asset('assets/layouts/img/profile-img.png') }}');
    }
</script>
@endpush
