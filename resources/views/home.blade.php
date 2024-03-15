@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')

<style>
  .date-time-text {
    font-size: 24px; /* Adjust the font size as desired */
  }
</style>


<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-lg-12">
              <div class="row">
                <!-- Real-time Date and Time -->
                <div class="col-md-12">
                  <div class="card date-time-card">
                    <div class="card-body">
                      <h5 class="card-title">Current Date and Time</h5>
                      <p id="date-time" class="date-time-text"></p>
                    </div>
                  </div>
                </div>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('youths.barangay.details') }}"> --}}
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Youths</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-users"></i>

                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalYouths }}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                    </div>
                  </div>
                </div>

              </div>
              {{-- </a> --}}
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('dashboard.bmi.details', 'normal') }}"> --}}
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Males</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-male"></i>

                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalMales }}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                    </div>
                  </div>
                </div>

              </div>
              {{-- </a> --}}
            </div><!-- End Revenue Card -->
          <!-- Revenue Card -->
          
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('dashboard.bmi.details', 'underweight') }}"> --}}
              <div class="card info-card underweight-card">
                <div class="card-body">
                  <h5 class="card-title">Females</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-female"></i>

                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalFemales }}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
              {{-- </a> --}}
            </div><!-- End Revenue Card -->
          <!-- Revenue Card -->
          


          <div class="col-xxl-4 col-md-4">
            {{-- <a href="{{ route('dashboard.barangay.details') }}"> --}}
            <div class="card info-card barangay-card">
              <div class="card-body">
                <h5 class="card-title">Child Youths<span>(15-17 years old)</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    {{-- <i class="bi bi-building"></i> --}}
                    <i class="fas fa-child"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalChildYouths }}</h6>
                    <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
            {{-- </a> --}}
          </div><!-- End Revenue Card -->

          <div class="col-xxl-4 col-md-4">
            {{-- <a href="{{ route('dashboard.barangay.details') }}"> --}}
            <div class="card info-card barangay-card">
              <div class="card-body">
                <h5 class="card-title">Core Youths<span>(18-24 years old)</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalCoreYouths }}</h6>
                    <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
            {{-- </a> --}}
          </div><!-- End Revenue Card -->


          <div class="col-xxl-4 col-md-4">
            {{-- <a href="{{ route('dashboard.barangay.details') }}"> --}}
            <div class="card info-card barangay-card">
              <div class="card-body">
                <h5 class="card-title">Young Adults<span>(25-30 years old)</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalYoungAdults }}</h6>
                    <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
            {{-- </a> --}}
          </div><!-- End Revenue Card -->


            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('dashboard.bmi.details', 'overweight') }}"> --}}
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Out of School Youths</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-school"></i>

                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalOutOfSchoolYouths }}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
              {{-- </a> --}}
            </div><!-- End Revenue Card -->
          <!-- Revenue Card -->
          

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('dashboard.bmi.details', 'obese') }}"> --}}
                <div class="card info-card overweight-card">
                  <div class="card-body">
                    <h5 class="card-title">Registered SK Voters</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-vote-yea"></i>

                      </div>
                      <div class="ps-3">
                        <h6>{{ $totalRegisteredSKVoters }}</h6>
                        <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                      </div>
                    </div>
                  </div>

                </div>
              {{-- </a> --}}
            </div><!-- End Revenue Card -->
          <!-- Revenue Card -->
          
            <div class="col-xxl-4 col-md-4">
              {{-- <a href="{{ route('dashboard.barangay.details') }}"> --}}
              {{-- <div class="card info-card barangay-card"> --}}
              <div class="card info-card overweight-card">

                <div class="card-body">
                  <h5 class="card-title">Overage Youths</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalOverageYouths }}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
              {{-- </a> --}}
            </div><!-- End Revenue Card -->


        
        
       </div>



       

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->

      </div>




      <script>
        function updateDateTime() {
          var now = new Date();
          var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
          var formattedDateTime = now.toLocaleString('en-US', options);
          document.getElementById('date-time').textContent = formattedDateTime;
        }
      
        // Update date and time every second
        setInterval(updateDateTime, 1000);
      </script>


</section>

@endsection


