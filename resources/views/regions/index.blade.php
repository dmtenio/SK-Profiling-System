
@extends('layouts.app')

@section('page-title', 'Regions')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">

          <div class="card-header mb-3">
            <!-- <div class="card-tools"> -->

                <h5 class="card-title">List of Regions</h5>
            
                                   <!-- Button trigger add modal -->
                                   <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <i class="bi bi-plus-lg"></i>
                                   Add Region
                                   </button>
                                   
                                   <!-- Modal for add -->
                                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New Region</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{route('regions.store')}}" method="post">
                                                                                
                                            @csrf  
                            
                                             <div class="modal-body">
                                                                            
                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Input Region Name" name="name" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                         </form>

                                       </div>
                                     </div>
                                   </div>
                                   
                                   
            <!-- </div> -->
                         
          </div>
        
          <div class="card-body">
              <!-- <h5 class="card-title">List of Regions</h5> -->
          

              <div class="table-responsive">
                <table id="regiontable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Date Modified</th> --}}
                            <th style="width:5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($regions as $region )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$region->name}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Button trigger edit modal -->
                                        <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdEdit-{{$region->id}}">
                                        <i class="bi bi-pencil-square"></i>
                                        <!-- Edit -->
                                        </button>

                                        <!-- Button trigger delete modal -->
                                        <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$region->id}}">
                                        <i class="bi bi-trash3"></i>
                                        <!-- Delete -->
                                        </button>
                                    </div>



                                    <!-- Modal for edit -->
                                   <div class="modal fade" id="modelIdEdit-{{$region->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">Edit Region</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{route('regions.update',$region->id)}}" method="post">
                                            @csrf  
                                            @method('PUT') 
                                             <div class="modal-body">
                                                                            
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Input Region Name" name="name" required value="{{ old('name',$region->name)}}">
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
                                    <div class="modal fade" id="modelIdDelete-{{$region->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
        
                                            <form action="{{route('regions.destroy', $region->id)}}" method="POST">    
                                                @csrf  
                                                @method('DELETE')
                                                <div class="modal-body">
                                                                                
                                                        <div class="modal-body">
                                                            Are you sure to delete Region: <strong>{{$region->name}}</strong> ?
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


                                </td>

                            </tr>
                        @endforeach --}}

                    </tbody>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Name</th>
                            {{-- <th>Date Modified</th> --}}
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

        // $(document).ready(function () {
        //     $('#regiontable').DataTable();
        // });

        $(document).ready(function () {
            $('#regiontable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('regions.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
              }
              );
        });

    </script>

@endpush