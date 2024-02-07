<div class="btn-group" role="group" aria-label="Action Group">

    <!-- Button trigger edit modal -->
    {{-- <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdEdit-{{$purok->id}}"> --}}
    <button type="button" class="btn btn-primary btn-sm modal-edit" title="Edit" data-id="{{$purok->id}}" onclick="showEditBarangayModal(this)">

      <i class="bi bi-pencil-square"></i>
    <!-- Edit -->
    </button>
    

    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$purok->id}}">
    <i class="bi bi-trash3"></i>
    <!-- Delete -->
    </button>
</div>



<!-- Modal for edit -->
<div class="modal fade" id="modelIdEdit-{{$purok->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{{route('puroks.update',$purok->id)}}" method="post">
@csrf  
@method('PUT') 
<div class="modal-body">

{{-- <div class="mb-3">
<label for="region" class="form-label">Region</label>
<select class="form-select edit-region" name="region" id="edit_region_id_{{$purok->id}}" data-placeholder="Select a region">
<option></option>
@foreach ($regions as $region)
<option value="{{ $region->id }}" {{ $purok->province->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
@endforeach
</select>
</div> --}}

<div class="mb-3">
<label for="barangay" class="form-label">Barangay</label>
<select class="form-select edit-barangay" name="barangay_id" id="edit_barangay_id_{{$purok->id}}" data-placeholder="Select a barangay">
<option></option>
@foreach ($barangays as $barangay)
<option value="{{ $barangay->id }}" {{ $purok->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
@endforeach
</select>    
</div>


<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" id="edit_name" placeholder="Input Purok Name" name="name" required value="{{ old('name',$purok->name)}}">
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
<div class="modal fade" id="modelIdDelete-{{$purok->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{route('puroks.destroy', $purok->id)}}" method="POST">    
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                                            
                    <div class="modal-body">
                        Are you sure to delete Purok: <strong>{{$purok->name}}</strong> ?
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
