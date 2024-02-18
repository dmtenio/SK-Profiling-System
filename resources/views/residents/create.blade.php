@extends('layouts.app')

@section('page-title', 'KK Survey Questionnaire')

@section('content')

@include('message.success')
@include('message.error')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">KK Survey Questionnaire</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('residents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h4 class="mb-3">I. PROFILE</h4>
                        <h5><label for="respondent_name" class="form-label">Name of Respondent</label></h5>
                                                
                        <div class="row mb-3">
                            <div class="col">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="col">
                                <label for="suffix" class="form-label">Suffix</label>
                                <input type="text" class="form-control" id="suffix" name="suffix">
                            </div>
                        </div>

                    
                        

                        <div class="row mb-3">
                            <div class="col">
                                <label for="purok" class="form-label">Purok/Zone</label>
                                <select name="purok_id" id="purok" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}">{{ $purok->name }}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                            <div class="col">
                                <label for="barangay" class="form-label">Barangay</label>
                                <select name="barangay_id" id="barangay" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($barangays as $barangay)
                                        @if ($user->account_type === 'barangay_user' || $user->account_type === 'barangay_admin')
                                            <option value="{{ $barangay->id }}" {{ $user->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
                                        @else
                                            <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="city_municipality" class="form-label">City/Municipality</label>
                                <select name="city_municipality" id="city_municipality" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($municipalities as $municipality)
                                        @if ($user->account_type === 'barangay_user' || $user->account_type === 'barangay_admin' || $user->account_type === 'municipal_admin')
                                            <option value="{{ $municipality->id }}" {{ $user->barangay->municipality_id == $municipality->id ? 'selected' : '' }}>{{ $municipality->name }}</option>
                                        @else
                                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                                <label for="province" class="form-label">Province</label>
                                <select name="province_id" id="province" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($provinces as $province)
                                        @if ($user->account_type === 'barangay_user' || $user->account_type === 'barangay_admin' || $user->account_type === 'municipal_admin' || $user->account_type === 'provincial_admin')
                                            <option value="{{ $province->id }}" {{ $user->barangay->municipality->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                        @else
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="region" class="form-label">Region</label>
                                <select name="region_id" id="region" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($regions as $region)
                                        @if ($user->account_type === 'barangay_user' || $user->account_type === 'barangay_admin' || $user->account_type === 'municipal_admin' || $user->account_type === 'provincial_admin')
                                            <option value="{{ $region->id }}" {{ $user->barangay->municipality->province->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @else
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="row mb-3 align-items-center">
                            <div class="col mt-3">
                                <label class="form-label">Sex Assigned by Birth</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <label for="dob" class="form-label">Birthday (mm/dd/yyyy)</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col"></div>
                            
                            <div class="col">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" readonly>
                            </div>

                            <div class="col">
                                <label for="contact_number" class="form-label">Contact #</label>
                                <input type="text" class="form-control" id="contact_number" name="mobile_num">
                            </div>
                        </div>
                        
                            <h4 class="mb-3">II. DEMOGRAPHIC CHARACTERISTICS</h4>
                        
                            <div class="mb-3">

                                <label class="form-label">Civil Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="single" id="civil_status_single" name="civil_status">
                                    <label class="form-check-label" for="civil_status_single">
                                        Single
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="married" id="civil_status_married" name="civil_status">
                                    <label class="form-check-label" for="civil_status_married">
                                        Married
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="widowed" id="civil_status_widowed" name="civil_status">
                                    <label class="form-check-label" for="civil_status_widowed">
                                        Widowed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="divorced" id="civil_status_divorced" name="civil_status">
                                    <label class="form-check-label" for="civil_status_divorced">
                                        Divorced
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="separated" id="civil_status_separated" name="civil_status">
                                    <label class="form-check-label" for="civil_status_separated">
                                        Separated
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="annulled" id="civil_status_annulled" name="civil_status">
                                    <label class="form-check-label" for="civil_status_annulled">
                                        Annulled
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="unknown" id="civil_status_unknown" name="civil_status">
                                    <label class="form-check-label" for="civil_status_unknown">
                                        Unknown
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="live-in" id="civil_status_live_in" name="civil_status">
                                    <label class="form-check-label" for="civil_status_live_in">
                                        Live-in
                                    </label>
                                </div>

                            </div>
                        
                            <div class="mb-3">
                               
                                <label class="form-label">Youth Age Group</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="child_youth" id="youth_age_group_child_youth" name="youth_group">
                                    <label class="form-check-label" for="youth_age_group_child_youth">
                                        Child Youth (15-17 yrs old)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="core_youth" id="youth_age_group_core_youth" name="youth_group">
                                    <label class="form-check-label" for="youth_age_group_core_youth">
                                        Core Youth (18-24 yrs old)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="young_adult" id="youth_age_group_young_adult" name="youth_group">
                                    <label class="form-check-label" for="youth_age_group_young_adult">
                                        Young Adult (15-30 yrs old)
                                    </label>
                                </div>

                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Educational Background</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="elementary_level" id="educational_background_elementary_level" name="educational_background">
                                    <label class="form-check-label" for="educational_background_elementary_level">
                                        Elementary Level
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="elementary_grad" id="educational_background_elementary_grad" name="educational_background">
                                    <label class="form-check-label" for="educational_background_elementary_grad">
                                        Elementary Grad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="high_school_level" id="educational_background_high_school_level" name="educational_background">
                                    <label class="form-check-label" for="educational_background_high_school_level">
                                        High School Level
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="high_school_grad" id="educational_background_high_school_grad" name="educational_background">
                                    <label class="form-check-label" for="educational_background_high_school_grad">
                                        High School Grad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="vocational_grad" id="educational_background_vocational_grad" name="educational_background">
                                    <label class="form-check-label" for="educational_background_vocational_grad">
                                        Vocational Grad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="college_level" id="educational_background_college_level" name="educational_background">
                                    <label class="form-check-label" for="educational_background_college_level">
                                        College Level
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="college_grad" id="educational_background_college_grad" name="educational_background">
                                    <label class="form-check-label" for="educational_background_college_grad">
                                        College Grad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="masters_level" id="educational_background_masters_level" name="educational_background">
                                    <label class="form-check-label" for="educational_background_masters_level">
                                        Masters Level
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="masters_grad" id="educational_background_masters_grad" name="educational_background">
                                    <label class="form-check-label" for="educational_background_masters_grad">
                                        Masters Grad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="doctorate_level" id="educational_background_doctorate_level" name="educational_background">
                                    <label class="form-check-label" for="educational_background_doctorate_level">
                                        Doctorate Level
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="doctorate_graduate" id="educational_background_doctorate_graduate" name="educational_background">
                                    <label class="form-check-label" for="educational_background_doctorate_graduate">
                                        Doctorate Graduate
                                    </label>
                                </div>
                            </div>
                                                    
                            <div class="mb-3">
                                <label class="form-label">Youth Classification</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="in_school_youth" id="in_school_youth" name="youth_classification">
                                    <label class="form-check-label" for="in_school_youth">
                                        In School Youth
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="out_of_school_youth" id="out_of_school_youth" name="youth_classification">
                                    <label class="form-check-label" for="out_of_school_youth">
                                        Out of School Youth
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="working_youth" id="working_youth" name="youth_classification">
                                    <label class="form-check-label" for="working_youth">
                                        Working Youth
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="youth_with_specific_needs" id="youth_with_specific_needs" name="youth_classification">
                                    <label class="form-check-label" for="youth_with_specific_needs">
                                        Youth with Specific needs
                                    </label>
                                </div>
                                <!-- Additional options for specific needs initially hidden -->
                                <div id="specific_needs_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="person_with_disability" id="person_with_disability" name="youth_specific_needs">
                                        <label class="form-check-label" for="person_with_disability">
                                            Person with Disability
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="children_in_conflict_with_law" id="children_in_conflict_with_law" name="youth_specific_needs">
                                        <label class="form-check-label" for="children_in_conflict_with_law">
                                            Children in Conflict with Law
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="indigenous_people" id="indigenous_people" name="youth_specific_needs">
                                        <label class="form-check-label" for="indigenous_people">
                                            Indigenous People
                                        </label>
                                    </div>
                                </div>
                            </div>
                                                    
                            <div class="mb-3">
                                <label class="form-label">Work Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="employed" id="work_status_employed" name="work_status">
                                    <label class="form-check-label" for="work_status_employed">
                                        Employed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="unemployed" id="work_status_unemployed" name="work_status">
                                    <label class="form-check-label" for="work_status_unemployed">
                                        Unemployed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="self_employed" id="work_status_self_employed" name="work_status">
                                    <label class="form-check-label" for="work_status_self_employed">
                                        Self-Employed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="looking_for_job" id="work_status_looking_for_job" name="work_status">
                                    <label class="form-check-label" for="work_status_looking_for_job">
                                        Currently looking for a Job
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="not_interested_looking_for_job" id="work_status_not_interested_looking_for_job" name="work_status">
                                    <label class="form-check-label" for="work_status_not_interested_looking_for_job">
                                        Not Interested Looking for a Job
                                    </label>
                                </div>
                            </div>
                            
                        
                            <div class="mb-3">
                                <label class="form-label">Registered SK Voter?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="registered_sk_voter_yes" name="sk_voter">
                                    <label class="form-check-label" for="registered_sk_voter_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="registered_sk_voter_no" name="sk_voter">
                                    <label class="form-check-label" for="registered_sk_voter_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Did you vote last SK election?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="last_sk_election_vote_yes" name="voted_last_sk">
                                    <label class="form-check-label" for="last_sk_election_vote_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="last_sk_election_vote_no" name="voted_last_sk">
                                    <label class="form-check-label" for="last_sk_election_vote_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Registered National Voter?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="registered_national_voter_yes" name="national_voter">
                                    <label class="form-check-label" for="registered_national_voter_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="registered_national_voter_no" name="national_voter">
                                    <label class="form-check-label" for="registered_national_voter_no">
                                        No
                                    </label>
                                </div>
                            </div>
                                                    
                            <div class="mb-3">
                                <label class="form-label">Have you already attended a KK Assembly?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="attended_kk_assembly_yes" name="attended_assembly">
                                    <label class="form-check-label" for="attended_kk_assembly_yes">
                                        Yes
                                    </label>
                                </div>
                                <!-- Additional options for "Yes" initially hidden -->
                                <div id="attended_kk_assembly_yes_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1-2_times" id="attended_kk_assembly_1_2_times" name="attended_yes_how_many">
                                        <label class="form-check-label" for="attended_kk_assembly_1_2_times">
                                            1-2 Times
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="3-4_times" id="attended_kk_assembly_3_4_times" name="attended_yes_how_many">
                                        <label class="form-check-label" for="attended_kk_assembly_3_4_times">
                                            3-4 Times
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="5_and_above" id="attended_kk_assembly_5_and_above" name="attended_yes_how_many">
                                        <label class="form-check-label" for="attended_kk_assembly_5_and_above">
                                            5 and above
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="attended_kk_assembly_no" name="attended_assembly">
                                    <label class="form-check-label" for="attended_kk_assembly_no">
                                        No
                                    </label>
                                </div>
                                
                                <!-- Additional options for "No" initially hidden -->
                                <div id="attended_kk_assembly_no_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="no_meeting" id="attended_kk_assembly_no_meeting" name="attended_no_why">
                                        <label class="form-check-label" for="attended_kk_assembly_no_meeting">
                                            There was no KK Assembly Meeting
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="not_interested" id="attended_kk_assembly_not_interested" name="attended_no_why">
                                        <label class="form-check-label" for="attended_kk_assembly_not_interested">
                                            Not Interested to Attend
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Image (Optional)</label>
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
    
                                                    
                            <!-- Add more demographic characteristics if necessary -->
                                                
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                        <div class="row mb-3">
                            <div class="col"></div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@push('page-scripts')

<script>

    $(document).ready(function() {
        // Initialize Select2 
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select an option'
        });

        $('#region').change(function() {
            var regionId = $(this).val();
            if(regionId) {
                $.ajax({
                    type: "GET",
                    url: "/get-provinces/" + regionId,
                    success: function(data) {
                        $('#province').empty();
                        $.each(data, function(key, value) {
                            $('#province').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        $('#province').change(function() {
            var provinceId = $(this).val();
            if(provinceId) {
                $.ajax({
                    type: "GET",
                    url: "/get-municipalities/" + provinceId,
                    success: function(data) {
                        $('#city_municipality').empty();
                        $.each(data, function(key, value) {
                            $('#city_municipality').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        $('#city_municipality').change(function() {
            var municipalityId = $(this).val();
            if(municipalityId) {
                $.ajax({
                    type: "GET",
                    url: "/get-barangays/" + municipalityId,
                    success: function(data) {
                        $('#barangay').empty();
                        $.each(data, function(key, value) {
                            $('#barangay').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        $('#barangay').change(function() {
            var barangayId = $(this).val();
            if(barangayId) {
                $.ajax({
                    type: "GET",
                    url: "/get-puroks/" + barangayId,
                    success: function(data) {
                        $('#purok').empty();
                        $.each(data, function(key, value) {
                            $('#purok').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });


        
    });


// JavaScript to set focus on the Last Name field when the view is loaded
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('last_name').focus();
});

// JavaScript to calculate age based on date of birth
// document.getElementById('dob').addEventListener('change', function() {
//     var dob = new Date(this.value);
//     var today = new Date();
//     var age = today.getFullYear() - dob.getFullYear();
//     var monthDiff = today.getMonth() - dob.getMonth();
//     if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
//         age--;
//     }
//     document.getElementById('age').value = age;
// });

document.getElementById('dob').addEventListener('change', function() {
    var dob = new Date(this.value);
    var today = new Date();
    var age = today.getFullYear() - dob.getFullYear();
    var monthDiff = today.getMonth() - dob.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    document.getElementById('age').value = age;

    // Select the appropriate radio button based on age
    var childYouthRadio = document.getElementById('youth_age_group_child_youth');
    var coreYouthRadio = document.getElementById('youth_age_group_core_youth');
    var youngAdultRadio = document.getElementById('youth_age_group_young_adult');

    if (age >= 15 && age <= 17) {
        childYouthRadio.checked = true;
    } else if (age >= 18 && age <= 24) {
        coreYouthRadio.checked = true;
    } else if (age >= 15 && age <= 30) {
        youngAdultRadio.checked = true;
    }
});


// Function to show or hide specific needs options based on the selection of Youth Classification
function toggleSpecificNeedsOptions() {
    var youthClassification = document.querySelector('input[name="youth_classification"]:checked');
    var specificNeedsOptions = document.getElementById('specific_needs_options');

    if (youthClassification && youthClassification.value === 'youth_with_specific_needs') {
        specificNeedsOptions.style.display = 'block';
    } else {
        specificNeedsOptions.style.display = 'none';
        // Deselect hidden radio buttons for Youth Classification
        var hiddenRadioButtons = specificNeedsOptions.querySelectorAll('input[type="radio"]');
        hiddenRadioButtons.forEach(function(radioButton) {
            radioButton.checked = false;
        });
    }
}

// Function to show additional options based on user selection for Attended KK Assembly
function toggleAttendedKKAssemblyOptions() {
    var attendedKKAssemblyYes = document.getElementById('attended_kk_assembly_yes');
    var attendedKKAssemblyNo = document.getElementById('attended_kk_assembly_no');
    var attendedYesOptions = document.getElementById('attended_kk_assembly_yes_options');
    var attendedNoOptions = document.getElementById('attended_kk_assembly_no_options');

    if (attendedKKAssemblyYes.checked) {
        attendedYesOptions.style.display = 'block';
        attendedNoOptions.style.display = 'none';
        // Deselect hidden radio buttons for Attended KK Assembly "No" option
        var hiddenRadioButtons = attendedNoOptions.querySelectorAll('input[type="radio"]');
        hiddenRadioButtons.forEach(function(radioButton) {
            radioButton.checked = false;
        });
    } else if (attendedKKAssemblyNo.checked) {
        attendedYesOptions.style.display = 'none';
        attendedNoOptions.style.display = 'block';
        // Deselect hidden radio buttons for Attended KK Assembly "Yes" option
        var hiddenRadioButtons = attendedYesOptions.querySelectorAll('input[type="radio"]');
        hiddenRadioButtons.forEach(function(radioButton) {
            radioButton.checked = false;
        });
    } else {
        attendedYesOptions.style.display = 'none';
        attendedNoOptions.style.display = 'none';
    }
}

// Add event listeners to the Youth Classification radio buttons
var youthClassificationRadios = document.querySelectorAll('input[name="youth_classification"]');
youthClassificationRadios.forEach(function(radio) {
    radio.addEventListener('change', toggleSpecificNeedsOptions);
});

// Add event listeners for Attended KK Assembly radio buttons
var attendedKKAssemblyRadios = document.querySelectorAll('input[name="attended_assembly"]');
attendedKKAssemblyRadios.forEach(function(radio) {
    radio.addEventListener('change', toggleAttendedKKAssemblyOptions);
});

// Call the functions initially to set the initial state based on the default selection
toggleSpecificNeedsOptions();
toggleAttendedKKAssemblyOptions();

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




</script>



@endpush