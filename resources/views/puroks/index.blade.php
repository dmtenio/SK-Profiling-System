
@extends('layouts.app')

@section('page-title', 'Puroks')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">

          <div class="card-header mb-3">
            <!-- <div class="card-tools"> -->

                <h5 class="card-title">List of Puroks</h5>
            
                                   <!-- Button trigger add modal -->
                                   <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <i class="bi bi-plus-lg"></i>
                                   Add Purok
                                   </button>
                                   
                                   <!-- Modal for add -->
                                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New Purok</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{route('puroks.store')}}" method="post">
                                                                                
                                            @csrf  
                            
                                             <div class="modal-body">
                                                                            
                                              {{-- <div class="mb-3">
                                                  <label for="region">Region:</label>
                                                  <select class="form-select" name="region" id="region_id" data-placeholder="Select a region" required>
                                                      <option></option>
                                                      @foreach ($regions as $region)
                                                          <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                      @endforeach
                                                  </select>
                                              </div> --}}
                          

                                              {{-- <div class="mb-3">
                                                  <label for="barangay">Barangay:</label>
                                                  <select class="form-select" name="barangay_id" id="barangay_id" data-placeholder="Select a barangay" required>
                                                      <option></option>
                                                      @foreach ($barangays as $barangay)
                                                          <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                                      @endforeach
                                                  </select>
                                              </div> --}}

                                            <div class="mb-3">
                                                <label for="barangay">Barangay:</label>
                                                <select class="form-select" name="barangay_id" id="barangay_id" data-placeholder="Select a barangay" required>
                                                    <option></option>
                                                    @foreach ($barangays as $barangay)
                                                        <option value="{{ $barangay->id }}" {{ ($user->account_type == 'barangay_admin' && $user->barangay->id == $barangay->id) ? 'selected' : '' }}>
                                                            {{ $barangay->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                
                                              

                                        

                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Input Purok Name" name="name" required>
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
              <!-- <h5 class="card-title">List of Puroks</h5> -->
          

              <div class="table-responsive">
                <table id="puroktable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Barangay</th>
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
                            <th>Barangay</th>
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

      $(document).ready(function () {
          $('#puroktable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('puroks.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'barangay_name', name: 'barangay_name'},
                  // {data: 'municipality_name', name: 'municipality_name'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
              }
            );

          $('#barangay_id').select2({
              theme: "bootstrap-5",
              width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
              placeholder: $(this).data('placeholder'),
              dropdownParent: $("#exampleModal"), // Change to the ID of the modal that contains your select element
          });

    
            //  // Initialize Select2 for regions in add modal
            //  $('#region_id').select2({
            //     theme: "bootstrap-5",
            //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            //     placeholder: "Select a region",
            //     dropdownParent: $("#exampleModal"), // Change to the ID of the modal that contains your select element
            // });
       

      });


      function showEditBarangayModal(el) {
        let editButton = el;
        let purokId = editButton.getAttribute('data-id');
        let modalEdit = $('#modelIdEdit-' + purokId).modal('show');

        $('#edit_barangay_id_' + purokId).select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select a barangay',
            dropdownParent: modalEdit,
        });

  
    }

      
    </script>

@endpush