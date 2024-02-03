<div class="btn-group" role="group" aria-label="Action Group">

    <!-- Button trigger edit modal -->
    {{-- <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdEdit-{{$province->id}}"> --}}
    <button type="button" class="btn btn-primary btn-sm modal-edit" title="Edit" data-id="{{$province->id}}" onclick="showEditRegionModal(this)">

    {{-- <button type="button" class="btn btn-primary btn-sm modal-edit" title="Edit" data-id="{{$province->id}}" onclick="showEditProvinceModal(this)"> --}}

    <i class="bi bi-pencil-square"></i>
    <!-- Edit -->
    </button>

    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$province->id}}">
    <i class="bi bi-trash3"></i>
    <!-- Delete -->
    </button>
</div>



<!-- Modal for edit -->
<div class="modal fade" id="modelIdEdit-{{$province->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Edit Province</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>

     <form action="{{route('provinces.update',$province->id)}}" method="post">
        @csrf  
        @method('PUT') 
         <div class="modal-body">
                                 
              
                <div class="mb-3">
                    <label for="region_id" class="col-form-label">Region:</label>
                    <!-- Add a dropdown or input field to select or display the region -->
                    <select class="form-select edit-region" name="region_id" id="edit_region_id_{{$province->id}}" data-placeholder="Select a region">
                        <option></option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ $region->id == $province->region_id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>


                
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <label for="name" class="col-form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Input Province Name" name="name" required value="{{ old('name',$province->name)}}">
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
<div class="modal fade" id="modelIdDelete-{{$province->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{route('provinces.destroy', $province->id)}}" method="POST">    
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                                            
                    <div class="modal-body">
                        Are you sure to delete Province: <strong>{{$province->name}}</strong> ?
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
