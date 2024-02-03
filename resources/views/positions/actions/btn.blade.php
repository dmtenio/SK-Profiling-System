<div class="btn-group" role="group" aria-label="Action Group">

    <!-- Button trigger edit modal -->
    <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdEdit-{{$position->id}}">
    <i class="bi bi-pencil-square"></i>
    <!-- Edit -->
    </button>

    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$position->id}}">
    <i class="bi bi-trash3"></i>
    <!-- Delete -->
    </button>
</div>


                                    <!-- Modal for edit -->
                                    <div class="modal fade" id="modelIdEdit-{{$position->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
       
                                            <form action="{{route('positions.update',$position->id)}}" method="post">
                                               @csrf  
                                               @method('PUT') 
                                                <div class="modal-body">
                                                                               
                                                       <div class="mb-3">
                                                           <label for="name" class="form-label">Name</label>
                                                           <label for="name" class="col-form-label">Name:</label>
                                                           <input type="text" class="form-control" id="name" placeholder="Input Position Name" name="name" required value="{{ old('name',$position->name)}}">
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
                                       <div class="modal fade" id="modelIdDelete-{{$position->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                           <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                               </div>
           
                                               <form action="{{route('positions.destroy', $position->id)}}" method="POST">    
                                                   @csrf  
                                                   @method('DELETE')
                                                   <div class="modal-body">
                                                                                   
                                                           <div class="modal-body">
                                                               Are you sure to delete Position: <strong>{{$position->name}}</strong> ?
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
   