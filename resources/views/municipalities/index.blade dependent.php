
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
                                   Add Municipalities
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
                                                                            
                                              {{-- for dependent select2 --}}
                                              <div class="mb-3">
                                                    <label for="region">Region:</label>
                                                    <select class="form-select" name="region" id="region_id" data-placeholder="Select a region" required>
                                                        <option></option>
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="province">Province:</label>
                                                    <select class="form-select" name="province" id="province_id" data-placeholder="Select a province" required>
                                                        <option></option>
                                                        <!-- Provinces will be dynamically loaded here using JavaScript -->
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
              <!-- <h5 class="card-title">List of Municipalities</h5> -->
          

              <div class="table-responsive">
                <table id="municipalitytable" class="table table-striped" style="width:100%">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Province</th>
                            <th>Region</th>
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
                            <th>Province</th>
                            <th>Region</th>
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
          $('#municipalitytable').DataTable(
              {
              processing: true,
              serverSide: true,
              ajax: "{{ route('municipalities.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'province_name', name: 'province_name'},
                  {data: 'region_name', name: 'region_name'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
              }
            );
            
            $('#region_id').select2({
                theme: "bootstrap-5",
                width: '100%',
                placeholder: "Select a region",
                dropdownParent: $("#exampleModal"),
            });

            // Initialize Select2 for provinces in add and edit modals
            $('#province_id').select2({
                theme: "bootstrap-5",
                width: '100%',
                placeholder: "Select a province",
                dropdownParent: $("#exampleModal"),
            });

            // Add event listener to update provinces based on selected region
            $('#region_id').on('change', function () {
                let regionId = $(this).val();
                if (regionId) {
                    // Make an AJAX request to fetch provinces based on the selected region
                    $.ajax({
                        url: '/get-provinces/' + regionId,
                        type: 'GET',
                        success: function (data) {
                            // Update the options of the province select
                            $('#province_id').empty().append('<option></option>');
                            $.each(data, function (key, value) {
                                $('#province_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    // Clear the province select when no region is selected
                    $('#province_id').empty().append('<option></option>');
                }
            });

            // Add event listener to update provinces based on selected region in the edit modal
            $('.edit-region').on('change', function () {
                let regionId = $(this).val();
                let municipalityId = $(this).attr('id').split('_')[3];

                if (regionId) {
                    // Make an AJAX request to fetch provinces based on the selected region
                    $.ajax({
                        url: '/get-provinces/' + regionId,
                        type: 'GET',
                        success: function (data) {
                            // Update the options of the province select in the edit modal
                            $('#edit_province_id_' + municipalityId).empty().append('<option></option>');
                            $.each(data, function (key, value) {
                                $('#edit_province_id_' + municipalityId).append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    // Clear the province select in the edit modal when no region is selected
                    $('#edit_province_id_' + municipalityId).empty().append('<option></option>');
                }
            });
        });

        
      function showEditProvinceModal(el) {
            let editButton = el;
            let municipalityId = editButton.getAttribute('data-id');
            let modalEdit = $('#modelIdEdit-' + municipalityId).modal('show');

            $('#edit_province_id_' + municipalityId).select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Select a province',
                dropdownParent: modalEdit,
            });

            $('#edit_region_id_' + municipalityId).select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Select a region',
                dropdownParent: modalEdit,
            });
        }

        
    </script>

@endpush