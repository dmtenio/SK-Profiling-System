<div class="btn-group" role="group" aria-label="Action Group">

    <!-- Button trigger edit modal -->
    <button type="button" class="btn btn-primary btn-sm modal-edit" title="Edit" data-id="{{$barangay->id}}" onclick="showEditBarangayModal(this)">

      <i class="bi bi-pencil-square"></i>
    <!-- Edit -->
    </button>
    

    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$barangay->id}}">
    <i class="bi bi-trash3"></i>
    <!-- Delete -->
    </button>
</div>



<!-- Modal for edit -->
<div class="modal fade" id="modelIdEdit-{{$barangay->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Barangay</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{{route('barangays.update',$barangay->id)}}" method="post">
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
    <label for="municipality" class="form-label">Municipality</label>
    <select class="form-select edit-municipality" name="municipality_id" id="edit_municipality_id_{{$barangay->id}}" data-placeholder="Select a municipality">
    <option></option>
    @foreach ($municipalities as $municipality)
    <option value="{{ $municipality->id }}" {{ $barangay->municipality->id == $municipality->id ? 'selected' : '' }}>{{ $municipality->name }}</option>
    @endforeach
    </select>    
</div>

<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" id="edit_name" placeholder="Input Barangay Name" name="name" required value="{{ old('name',$barangay->name)}}">
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
<div class="modal fade" id="modelIdDelete-{{$barangay->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{route('barangays.destroy', $barangay->id)}}" method="POST">    
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                                            
                    <div class="modal-body">
                        Are you sure to delete Barangay: <strong>{{$barangay->name}}</strong> ?
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
