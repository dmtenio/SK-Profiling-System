<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKProfiler</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('assets/login-workspace/images/skp_s_logo.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/welcome/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/aos/aos.css" rel="stylesheet') }}">
  <link href="{{ asset('assets/welcome/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/welcome/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->

  <link href="{{ asset('assets/welcome/css/style.css') }}" rel="stylesheet">

  <style>
   .custom-topbar {
      background-color: blue !important; /* Change 'blue' to your desired color */
    }
    .custom-text-color {
      color: blue; /* Change 'blue' to your desired text color */
    }


</style>


</head>

<body>

  <!-- ======= Top Bar ======= -->
  {{-- <div id="topbar" class="d-flex align-items-center fixed-top" style="background-color: blue;"  > --}}
  <div id="topbar" class="d-flex align-items-center fixed-top custom-topbar">


    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i> 
        <span id="current-date-time">{{ date('Y-m-d H:i:s') }}</span>
      </div>
      <!-- <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Call us now +1 5589 55488 55
      </div> -->
    </div>
  </div>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      {{-- <a href="{{ url('/') }}" class="logo me-auto"><img src="{{ asset('assets/welcome/img/logo.png')}}" alt=""></a> --}}
      
      <a href="{{ url('/') }}" class="logo me-auto">
        <img src="{{ asset('assets/login-workspace/images/skp_s_logo.png') }}" alt="">
        {{-- <span class="">SK Profiling Management Information System</span> --}}
        <span class="custom-text-color">SK Profiler</span>

      </a>

      <!-- Uncomment below if you prefer to use an image logo -->
       {{-- <h1 class="logo me-auto"><a href="{{ url('/') }}">Reach and Care Information System</a></h1> --}}

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> -->

      @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="appointment-btn scrollto">Dashboard</a>

                        @else
                        <a href="{{ route('login') }}" class="appointment-btn scrollto">Login</a>


                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="appointment-btn scrollto">Register</a>
    
                         @endif -->
                    @endif
        @endif


    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/welcome/img/slide/slide-1.jpg)">

          {{-- <div class="container">
            <h2>Welcome to <span>RaCIS-TANDAG</span></h2>
            <p>TANDAG CITY, Surigao del Sur (PIA) – The city government here through the City Nutrition Office successfully conducted the virtual forum on the First 1,000 days of life in time with the 47th Nutrition Month Celebration with the theme, "Malnutrition Patuloy Na Labanan, First 1000 Days Tutukan" on Friday, July 2, 2021.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> --}}
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-2.jpg)">
          <!-- <div class="container">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-3.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>


        <!-- Slide 4 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-4.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>

          <!-- Slide 5 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-5.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>


        <!-- Slide 6 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-6.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>

          <!-- Slide 7 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-7.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>

        <!-- Slide 8 -->
        <div class="carousel-item" style="background-image: url(assets/welcome/img/slide/slide-8.jpg)">
          <!-- <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div> -->
        </div>

        


      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
          <p>SKProfiler is a comprehensive web-based platform developed to streamline the management and profiling of Sangguniang Kabataan (SK) members across various barangays. It serves as a centralized system designed to gather, organize, and analyze pertinent data related to youth demographics, civic engagement, and community involvement within the SK framework.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ asset('assets/welcome/img/abouts.jpg')}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>Objectives:</h3>
            <!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p> -->
            <ul>
                <li><i class="bi bi-check-circle"></i> Efficiently collect and manage demographic data of Sangguniang Kabataan (SK) members.</li>
                <li><i class="bi bi-check-circle"></i> Profile the youth population to understand their characteristics and needs.</li>
                <li><i class="bi bi-check-circle"></i> Establish a centralized database for secure storage of collected data.</li>
                <li><i class="bi bi-check-circle"></i> Analyze data to identify trends and insights to inform program development.</li>
                <li><i class="bi bi-check-circle"></i> Empower SK officials to effectively address and advocate for youth-related issues within their communities.</li>                          
            </ul>
            <!-- <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p> -->
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->





  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    
    <div class="container">
      <div class="copyright">
        <p class="mb-1">&copy; 2024 <a href="https://dmtenio.github.io/" class="font-weight-bold text-dark" target="_blank">SKProfiler</a>, All Rights Reserved.</p>
        <p class="mb-1">Developed and Maintained by <a href="https://dmtenio.github.io/" target="_blank" class="font-weight-bold text-dark">10uSolutions</a></p>
      </div>
  
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/welcome/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('assets/welcome/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('assets/welcome/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/welcome/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('assets/welcome/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('assets/welcome/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/welcome/js/main.js')}}"></script>

  <script>
    function updateDateTime() {
      var dateTimeElement = document.getElementById('current-date-time');
      var currentDateTime = new Date().toLocaleString(); // Get current date and time
      dateTimeElement.textContent = currentDateTime; // Update the element with the current date and time
    }
  
    // Update the date and time every second
    setInterval(updateDateTime, 1000);
  </script>
  

</body>

</html>