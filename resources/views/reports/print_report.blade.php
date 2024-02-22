<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Report</title>
    <!-- Include any necessary CSS styles specific to the printable report -->
    <style>
        /* Example CSS styles */
        @page {
            size: 13in 8.5in landscape; /* Set landscape orientation and 8.5 x 13 inches size */
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; /* Adjust as needed */
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>
    <h1>KATIPUNAN NG KABATAAN YOUTH PROFILE</h1>
    <table>
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
    <!-- Optionally, you can include a script to automatically trigger printing -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
