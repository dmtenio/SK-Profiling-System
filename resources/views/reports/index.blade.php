@extends('layouts.app')

@section('page-title', 'Reports')

@section('content')


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title">KATIPUNAN NG KABATAAN YOUTH PROFILE</h5>
                    <button class="btn btn-primary btn-sm float-end" onclick="printReport()">
                        <i class="bi bi-printer"></i>
                        Print
                    </button>                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="residentstable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>REGION</th>
                                    <th>PROVINCE</th>
                                    <th>CITY/MUNICIPALITY</th>
                                    <th>BARANGAY</th>
                                    <th>NAME</th>
                                    <th>AGE</th>
                                    <th>BIRTHDAY</th>
                                    <th>SEX ASSIGNED AT BIRTH</th>
                                    <th>CIVIL STATUS</th>
                                    <th>YOUTH CLASSIFICATION ISY/OSY-NEET/WY/YSN (PWD/IP)</th>
                                    <th>YOUTH AGE GROUP</th>
                                    <th>EMAIL ADDRESS</th>
                                    <th>CONTACT NUMBER</th>
                                    <th>HOME ADDRESS</th>
                                    <th>HIGHEST EDUCATIONAL ATTAINMENT</th>
                                    <th>WORK STATUS</th>
                                    <th>Registered voter?</th>
                                    <th>Voted Last Election?</th>
                                    <th>Attended a KK assembly?</th>
                                    <th>If yes, how many times?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($residents as $resident)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resident->barangay->municipality->province->region->name }}</td>
                                    <td>{{ $resident->barangay->municipality->province->name }}</td>
                                    <td>{{ $resident->barangay->municipality->name }}</td>
                                    <td>{{ $resident->barangay->name }}</td>
                                    <td>{{ $resident->first_name }} {{ $resident->middle_name ?? '' }} {{ $resident->last_name }} {{ $resident->suffix ?? '' }}</td>
                                    <td>{{ $resident->age }}</td>
                                    <td>{{ $resident->dob }}</td>
                                    <td>{{ $resident->gender }}</td>
                                    <td>{{ $resident->civil_status }}</td>
                                    <td>{{ $resident->youth_classification }}</td>
                                    <td>{{ $resident->youth_group }}</td>
                                    <td>{{ $resident->email }}</td>
                                    <td>{{ $resident->mobile_num }}</td>
                                    <td>{{ $resident->purok->name }}, {{ $resident->barangay->name }}, {{ $resident->barangay->municipality->name }}, {{ $resident->barangay->municipality->province->name }}, {{ $resident->barangay->municipality->province->region->name }}</td>
                                    <td>{{ $resident->educational_background }}</td>
                                    <td>{{ $resident->work_status }}</td>
                                    <td>{{ $resident->national_voter == 'yes' ? 'Y' : 'N' }}</td>
                                    <td>{{ $resident->voted_last_sk == 'yes' ? 'Y' : 'N' }}</td>
                                    <td>{{ $resident->attended_assembly == 'yes' ? 'Y' : 'N' }}</td>
                                    <td>{{ $resident->attended_yes_how_many }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('page-scripts')
<script>
    function printReport() {
        window.open('{{ route("reports.print") }}', '_blank');
    }
</script>
@endpush