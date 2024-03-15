<div class="btn-group" role="group" aria-label="Action Group">

    <!-- Button trigger edit modal -->
    {{-- <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdEdit-{{$official->id}}"> --}}
    <button type="button" class="btn btn-primary btn-sm modal-edit" title="Edit" data-id="{{$official->id}}" onclick="showEditBarangayModal(this)">

      <i class="bi bi-pencil-square"></i>
    <!-- Edit -->
    </button>
    

    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$official->id}}">
    <i class="bi bi-trash3"></i>
    <!-- Delete -->
    </button>
</div>



<!-- Modal for edit -->
<div class="modal fade" id="modelIdEdit-{{$official->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>


<form action="{{route('officials.update',$official->id)}}" method="post" enctype="multipart/form-data">
@csrf  
@method('PUT') 
<div class="modal-body">

{{-- <div class="mb-3">
<label for="region" class="form-label">Region</label>
<select class="form-select edit-region" name="region" id="edit_region_id_{{$official->id}}" data-placeholder="Select a region">
<option></option>
@foreach ($regions as $region)
<option value="{{ $region->id }}" {{ $official->province->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
@endforeach
</select>
</div> --}}

<div class="mb-3">
<label for="barangay" class="form-label">Barangay</label>
<select class="form-select edit-barangay" name="barangay_id" id="edit_barangay_id_{{$official->id}}" data-placeholder="Select a barangay">
<option></option>
@foreach ($barangays as $barangay)
<option value="{{ $barangay->id }}" {{ $official->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
@endforeach
</select>    
</div>


<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" id="edit_name" placeholder="Input Official Name" name="name" required value="{{ old('name',$official->name)}}">
</div>

<div class="mb-3">
    <label for="position" class="form-label">Position</label>
    <select class="form-select edit-position" name="position_id" id="edit_position_id_{{$official->id}}" data-placeholder="Select a position">
    <option></option>
    @foreach ($positions as $position)
    <option value="{{ $position->id }}" {{ $official->position_id == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
    @endforeach
    </select>
</div>


<div class="mb-3">
    <label for="avatar" class="form-label">Image</label>
    <div class="d-flex align-items-center">
        <div id="avatarPreviewContainer_{{$official->id}}" class="me-2 edit-avatarPreviewContainer {{$official->avatar ? '' : 'd-none'}}">
            <img id="avatarPreview_{{$official->id}}" src="{{ $official->avatar ? asset('storage/' . $official->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
        </div>
        <div class="flex-grow-1">
            <input type="file" name="avatar" accept="image/*" class="form-control edit-avatar" id="avatar_{{$official->id}}" onchange="editpreviewAvatar(this)">
        </div>
        <div class="ms-2">
            <label for="avatar_{{$official->id}}" class="btn btn-primary btn-sm" title="Upload new avatar"><i class="bi bi-upload"></i></label>
            <button type="button" class="btn btn-danger btn-sm" title="Remove avatar" onclick="editremoveAvatar()"><i class="bi bi-trash"></i></button>
        </div>        
    </div>
</div>



    

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Update</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>
</form>
</div>
</div>
</div>


<!-- Modal for delete -->
<div class="modal fade" id="modelIdDelete-{{$official->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{route('officials.destroy', $official->id)}}" method="POST">    
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                                            
                    <div class="modal-body">
                        Are you sure to delete Official: <strong>{{$official->name}}</strong> ?
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>

    </div>
    </div>
</div>
