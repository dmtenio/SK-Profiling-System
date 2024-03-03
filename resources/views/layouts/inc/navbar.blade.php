<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="{{ url('/') }}" class="logo d-flex align-items-center">
    <img src="{{ asset('assets/login-workspace/images/skp_s_logo.png') }}" alt="">
    <span class="d-none d-lg-block">SKProfiler</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

{{-- <div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar --> --}}




<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    {{-- <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon--> --}}






    

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        {{-- <img src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle"> --}}
        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name}}</span>
        {{-- <span class="d-none d-md-block dropdown-toggle ps-2">{{ implode(' ', array_filter([Auth::user()->first_name, Auth::user()->middle_name ? substr(Auth::user()->middle_name, 0, 1).'.' : '', Auth::user()->last_name])) }}</span> --}}

      </a><!-- End Profile Iamge Icon -->
      
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ Auth::user()->name }}</h6>                                              
          {{-- <h6>{{ implode(' ', array_filter([Auth::user()->first_name, Auth::user()->middle_name ? substr(Auth::user()->middle_name, 0, 1).'.' : '', Auth::user()->last_name])) }}</h6>           --}}
          
          @if (Auth::user()->account_type === 'barangay_user')
          <span>Barangay User</span>
          @elseif (Auth::user()->account_type === 'barangay_admin') 
          <span>Barangay Admin</span>
          @elseif (Auth::user()->account_type === 'municipal_admin') 
          <span>Municipal Admin</span>
          @elseif (Auth::user()->account_type === 'provincial_admin') 
          <span>Provincial Admin</span>
          @elseif (Auth::user()->account_type === 'super_admin') 
          <span>Super Admin</span>
          @endif
          
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit', Auth::user()->id) }}">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <!-- <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li> -->

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{-- {{ __('Logout') }}
                                    </a> --}}
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
            
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
          </form>
          
        </li>


      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
