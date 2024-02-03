
@extends('layouts.app')

@section('page-title', 'Positions')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">

          <div class="card-header mb-3">
            <!-- <div class="card-tools"> -->

                <h5 class="card-title">List of Positions</h5>
            
                                   <!-- Button trigger add modal -->
                                   <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <i class="bi bi-plus-lg"></i>
                                   Add Position
                                   </button>
                                   
                                   <!-- Modal for add -->
                                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New Position</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{route('positions.store')}}" method="post">
                                                                                
                                            @csrf  
                            
                                             <div class="modal-body">
                                                                            
                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Input Position Name" name="name" required>
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
          

              <div class="table-responsive">
                <table id="positiontable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Date Modified</th> --}}
                            <th style="width:5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                      
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
        //     $('#positiontable').DataTable();
        // });

        $(document).ready(function () {
            $('#positiontable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('positions.index') }}",
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