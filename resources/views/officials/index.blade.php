
@extends('layouts.app')

@section('page-title', 'Officials')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">

          <div class="card-header mb-3">
            <!-- <div class="card-tools"> -->

                <h5 class="card-title">List of Officials</h5>
            
                                    @if(auth()->user()->account_type == 'barangay_admin')
                                        <!-- Button to view organizational structure -->
                                        <button type="button" class="btn btn-primary btn-sm" onclick="viewOrganizationalStructure()">
                                            <i class="bi bi-diagram-2"></i>
                                            View Organizational Structure
                                        </button>
                                    @endif
            
                                
                                   <!-- Button trigger add modal -->
                                   <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <i class="bi bi-plus-lg"></i>
                                   Add Official
                                   </button>
                                   
                                   <!-- Modal for add -->
                                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New Official</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
    
                                         <form action="{{ route('officials.store') }}" method="post" enctype="multipart/form-data">

                                                                                
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
                                                        <input type="text" class="form-control" id="name" placeholder="Input Official Name" name="name" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="position">Position:</label>
                                                        <select class="form-select" name="position_id" id="position_id" data-placeholder="Select a position" required>
                                                            <option></option>
                                                            @foreach ($positions as $position)
                                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="avatar" class="form-label">Image</label>
                                                        <div class="d-flex align-items-center">
                                                            <div id="avatarPreviewContainer" class="me-2 d-none">
                                                                <img id="avatarPreview" src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
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
              <!-- <h5 class="card-title">List of Officials</h5> -->
          

              <div class="table-responsive">
                <table id="officialtable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
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
                            <th>Position</th>
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
    
    function viewOrganizationalStructure() {
        // Redirect to the page displaying the organizational structure
        window.location.href = "{{ route('structures.index') }}";
    }


      $(document).ready(function () {
          $('#officialtable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('officials.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'position_name', name: 'position_name'},
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

           $('#position_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: "Select a position",
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
        let officialId = editButton.getAttribute('data-id');
        let modalEdit = $('#modelIdEdit-' + officialId).modal('show');

        $('#edit_barangay_id_' + officialId).select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select a barangay',
            dropdownParent: modalEdit,
        });

        $('#edit_position_id_' + officialId).select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select a position',
            dropdownParent: modalEdit,
        });
    }


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

    

    function removeAvatar() {
        $('#avatar').val('');
        $('#avatarPreviewContainer').addClass('d-none');
    }



    function editpreviewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var officialId = input.id.split('_')[1]; // Extract the official ID from the input ID

            reader.onload = function (e) {
                $('#avatarPreview_' + officialId).attr('src', e.target.result);
                $('#avatarPreviewContainer_' + officialId).removeClass('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function editremoveAvatar() {
        $('.edit-avatar').val('');
        $('.edit-avatarPreviewContainer').addClass('d-none');
    }

      
    </script>

@endpush