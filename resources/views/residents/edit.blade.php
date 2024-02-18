@extends('layouts.app')

@section('page-title', 'Edit Youth')

@section('content')

@include('message.success')
@include('message.error')
  


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">Edit Youth</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('residents.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h4 class="mb-3">I. PROFILE</h4>
                            <h5><label for="respondent_name" class="form-label">Name of Respondent</label></h5>
                            
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $resident->last_name }}" required>
                                </div>
                                <div class="col">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $resident->first_name }}" required>
                                </div>
                                <div class="col">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $resident->middle_name }}">
                                </div>
                                <div class="col">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" name="suffix" value="{{ $resident->suffix }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="purok" class="form-label">Purok/Zone</label>
                                    <select name="purok_id" id="purok" class="form-control select2">
                                        <option value=""></option>
                                        @foreach ($puroks as $purok)
                                            <option value="{{ $purok->id }}" {{ $resident->purok_id == $purok->id ? 'selected' : '' }}>{{ $purok->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="barangay" class="form-label">Barangay</label>
                                    <select name="barangay_id" id="barangay" class="form-control select2">
                                        <option value=""></option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay->id }}" {{ $resident->barangay_id == $barangay->id ? 'selected' : '' }}>{{ $barangay->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="city_municipality" class="form-label">City/Municipality</label>
                                    <select name="city_municipality" id="city_municipality" class="form-control select2">
                                        <option value=""></option>
                                        @foreach ($municipalities as $municipality)
                                            <option value="{{ $municipality->id }}" {{ $resident->barangay->municipality_id == $municipality->id ? 'selected' : '' }}>{{ $municipality->name }}</option>
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
                                            <option value="{{ $province->id }}" {{ $resident->barangay->municipality->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="region" class="form-label">Region</label>
                                    <select name="region_id" id="region" class="form-control select2">
                                        <option value=""></option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}" {{ $resident->barangay->municipality->province->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col mt-3">
                                    <label class="form-label">Sex Assigned by Birth</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $resident->gender == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $resident->gender == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="dob" class="form-label">Birthday (mm/dd/yyyy)</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ $resident->dob }}">
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $resident->email }}">
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col"></div>
                                
                                <div class="col">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" value="{{ $resident->age }}" readonly>
                                </div>
                            
                                <div class="col">
                                    <label for="contact_number" class="form-label">Contact #</label>
                                    <input type="text" class="form-control" id="contact_number" name="mobile_num" value="{{ $resident->mobile_num }}">
                                </div>
                            </div>
                            
                            <h4 class="mb-3">II. DEMOGRAPHIC CHARACTERISTICS</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Civil Status</label>
                                @foreach(['single', 'married', 'widowed', 'divorced', 'separated', 'annulled', 'unknown', 'live-in'] as $status)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{ $status }}" id="civil_status_{{ $status }}" name="civil_status" {{ $resident->civil_status == $status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="civil_status_{{ $status }}">
                                            {{ ucfirst($status) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Youth Age Group</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="child_youth" id="youth_age_group_child_youth" name="youth_group" {{ $resident->youth_group == 'child_youth' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="youth_age_group_child_youth">
                                        Child Youth (15-17 yrs old)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="core_youth" id="youth_age_group_core_youth" name="youth_group" {{ $resident->youth_group == 'core_youth' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="youth_age_group_core_youth">
                                        Core Youth (18-24 yrs old)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="young_adult" id="youth_age_group_young_adult" name="youth_group" {{ $resident->youth_group == 'young_adult' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="youth_age_group_young_adult">
                                        Young Adult (15-30 yrs old)
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Educational Background</label>
                                @foreach(['elementary_level', 'elementary_grad', 'high_school_level', 'high_school_grad', 'vocational_grad', 'college_level', 'college_grad', 'masters_level', 'masters_grad', 'doctorate_level', 'doctorate_graduate'] as $background)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{ $background }}" id="educational_background_{{ $background }}" name="educational_background" {{ $resident->educational_background == $background ? 'checked' : '' }}>
                                        <label class="form-check-label" for="educational_background_{{ $background }}">
                                            {{ ucfirst(str_replace('_', ' ', $background)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Youth Classification</label>
                                @foreach(['in_school_youth', 'out_of_school_youth', 'working_youth', 'youth_with_specific_needs'] as $classification)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{ $classification }}" id="{{ $classification }}" name="youth_classification" {{ $resident->youth_classification == $classification ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $classification }}">
                                            {{ ucfirst(str_replace('_', ' ', $classification)) }}
                                        </label>
                                    </div>
                                @endforeach
                                <!-- Additional options for specific needs initially hidden -->
                                <div id="specific_needs_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="person_with_disability" id="person_with_disability" name="youth_specific_needs" {{ $resident->youth_specific_needs == 'person_with_disability' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="person_with_disability">
                                            Person with Disability
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="children_in_conflict_with_law" id="children_in_conflict_with_law" name="youth_specific_needs" {{ $resident->youth_specific_needs == 'children_in_conflict_with_law' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="children_in_conflict_with_law">
                                            Children in Conflict with Law
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="indigenous_people" id="indigenous_people" name="youth_specific_needs" {{ $resident->youth_specific_needs == 'indigenous_people' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="indigenous_people">
                                            Indigenous People
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Work Status</label>
                                @foreach(['employed', 'unemployed', 'self_employed', 'looking_for_job', 'not_interested_looking_for_job'] as $status)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{ $status }}" id="work_status_{{ $status }}" name="work_status" {{ $resident->work_status == $status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="work_status_{{ $status }}">
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Registered SK Voter?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="registered_sk_voter_yes" name="sk_voter" {{ $resident->sk_voter === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registered_sk_voter_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="registered_sk_voter_no" name="sk_voter" {{ $resident->sk_voter === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registered_sk_voter_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Did you vote last SK election?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="last_sk_election_vote_yes" name="voted_last_sk" {{ $resident->voted_last_sk === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="last_sk_election_vote_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="last_sk_election_vote_no" name="voted_last_sk" {{ $resident->voted_last_sk === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="last_sk_election_vote_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Registered National Voter?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="registered_national_voter_yes" name="national_voter" {{ $resident->national_voter === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registered_national_voter_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="registered_national_voter_no" name="national_voter" {{ $resident->national_voter === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registered_national_voter_no">
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Have you already attended a KK Assembly?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="yes" id="attended_kk_assembly_yes" name="attended_assembly" {{ $resident->attended_assembly === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attended_kk_assembly_yes">
                                        Yes
                                    </label>
                                </div>
                                <!-- Additional options for "Yes" initially hidden -->
                                <div id="attended_kk_assembly_yes_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1-2_times" id="attended_kk_assembly_1_2_times" name="attended_yes_how_many" {{ $resident->attended_yes_how_many === '1-2_times' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="attended_kk_assembly_1_2_times">
                                            1-2 Times
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="3-4_times" id="attended_kk_assembly_3_4_times" name="attended_yes_how_many" {{ $resident->attended_yes_how_many === '3-4_times' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="attended_kk_assembly_3_4_times">
                                            3-4 Times
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="5_and_above" id="attended_kk_assembly_5_and_above" name="attended_yes_how_many" {{ $resident->attended_yes_how_many === '5_and_above' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="attended_kk_assembly_5_and_above">
                                            5 and above
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no" id="attended_kk_assembly_no" name="attended_assembly" {{ $resident->attended_assembly === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attended_kk_assembly_no">
                                        No
                                    </label>
                                </div>
                                
                                <!-- Additional options for "No" initially hidden -->
                                <div id="attended_kk_assembly_no_options" style="display: none; margin-left: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="no_meeting" id="attended_kk_assembly_no_meeting" name="attended_no_why" {{ $resident->attended_no_why === 'no_meeting' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="attended_kk_assembly_no_meeting">
                                            There was no KK Assembly Meeting
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="not_interested" id="attended_kk_assembly_not_interested" name="attended_no_why" {{ $resident->attended_no_why === 'not_interested' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="attended_kk_assembly_not_interested">
                                            Not Interested to Attend
                                        </label>
                                    </div>
                                </div>
                            </div>
                                                        

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Image (Optional)</label>
                                <div class="d-flex align-items-center">
                                    <div id="avatarPreviewContainer" class="me-2">
                                        <img id="avatarPreview" src="{{ $resident->avatar ? asset('storage/' . $resident->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
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

                        <div class="mb-3">
                            <button class="btn btn-primary">Update</button>
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


    // Function to preview avatar image
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

    // Function to remove avatar image
    function removeAvatar() {
        $('#avatar').val('');
        $('#avatarPreviewContainer').addClass('d-none');
        $('#avatarPreview').attr('src', '{{ asset('assets/layouts/img/profile-img.png') }}');
    }

</script>


@endpush
