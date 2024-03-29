
@extends('layouts.app')

@section('page-title', 'Municipalities')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">

          <div class="card-header mb-3">
            <!-- <div class="card-tools"> -->

                <h5 class="card-title">List of Municipalities</h5>
            
                                   <!-- Button trigger add modal -->
                                   <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <i class="bi bi-plus-lg"></i>
                                   Add Municipality
                                   </button>
                                   
                                   <!-- Modal for add -->
                                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New Municipality</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{route('municipalities.store')}}" method="post">
                                                                                
                                            @csrf  
                            
                                             <div class="modal-body">
                                                                            
                                                <div class="mb-3">
                                                    <label for="province">Province:</label>
                                                    <select class="form-select" name="province_id" id="province_id" data-placeholder="Select a province" required>
                                                        <option></option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ ($user->account_type == 'provincial_admin' && $user->barangay->municipality->province->id == $province->id) ? 'selected' : '' }}>
                                                                {{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            

                                        

                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Input Municipality Name" name="name" required>
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
                <table id="municipalitytable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Province</th>
                            <th style="width:5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Name</th>
                            <th>Province</th>
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

          $('#municipalitytable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('municipalities.index') }}", // Update to the correct route
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'name', name: 'name' },
                  { data: 'province_name', name: 'province_name' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });

          $('#province_id').select2({
              theme: "bootstrap-5",
              width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
              placeholder: $(this).data('placeholder'),
              dropdownParent: $("#exampleModal"), // Change to the ID of the modal that contains your select element
          });


    });


      function showEditMunicipalityModal(el) {
            let editButton = el;
            let municipalityId = editButton.getAttribute('data-id');
            let modalEdit = $('#modelIdEdit-' + municipalityId).modal('show');

            $('#edit_municipality_id_' + municipalityId).select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Select a province',
                dropdownParent: modalEdit,
            });

        }
  
    

      
    </script>

@endpush