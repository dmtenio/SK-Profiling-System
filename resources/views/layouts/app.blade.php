<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  {{-- <title>{{ config('app.name') }}</title> --}}
  <title>SKProfiler</title>


  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
 <!-- Favicons -->
 <link href="{{ asset('assets/layouts/welcome/img/favicon.png') }}" rel="icon">
 <link href="{{ asset('assets/layouts/welcome/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/layouts/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/layouts/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- Or for RTL support -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/layouts/css/style.css') }}" rel="stylesheet">

    <!-- Datatables CSS B5 -->
     {{-- <link href="{{ asset('assets/datatables5/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/datatables5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    @stack('page-style')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts.inc.navbar')

  <!-- ======= Sidebar ======= -->

  @include('layouts.inc.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>@yield('page-title')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <!-- <li class="breadcrumb-item active">Dashboard</li> -->
          <li class="breadcrumb-item active">@yield('page-title')</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts.inc.footer')


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/layouts/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/layouts/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/layouts/js/main.js')}}"></script>

  <!-- Datatables JS B5 -->
  <script src="{{ asset('assets/datatables5/js/jquery-3.5.1.js')}}"></script>
  <script src="{{ asset('assets/datatables5/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('assets/datatables5/js/dataTables.bootstrap5.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @stack('page-scripts')

</body>

</html>