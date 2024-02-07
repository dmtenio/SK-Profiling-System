<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('home')) ? '' : 'collapsed' }}" href="{{route('home')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('admin/checkup/create')) ? '' : 'collapsed' }}" href="">
        <i class="bi bi-person-check"></i>
        <span>New Entry</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-heading">Master List</li>
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('residents')) ? '' : 'collapsed' }}" href="{{ route('residents.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Youths</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-heading">Maintenance</li>
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('users')) ? '' : 'collapsed' }}" href="{{route('users.index')}}">
        <i class="bi bi-people"></i>
        <span>Users</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('officials')) ? '' : 'collapsed' }}" href="{{ route('officials.index') }}">
        <i class="bi bi-people"></i>
        <span>Officials</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('positions')) ? '' : 'collapsed' }}" href="{{route('positions.index')}}">
        <i class="bi bi-person-badge"></i>
        <span>Positions</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('puroks')) ? '' : 'collapsed' }}" href="{{route('puroks.index')}}">
          <i class="bi bi-house-door"></i>
        <span>Puroks</span>
      </a>
    </li><!-- End Blank Page Nav -->
    
    <li class="nav-item">
      <a class="nav-link {{(request()->is('barangays')) ? '' : 'collapsed' }}" href="{{route('barangays.index')}}">
          <i class="bi bi-geo-alt"></i>
        <span>Barangays</span>
      </a>
    </li><!-- End Blank Page Nav -->
    
    <li class="nav-item">
      <a class="nav-link {{(request()->is('municipalities')) ? '' : 'collapsed' }}" href="{{route('municipalities.index')}}">
          <i class="bi bi-building"></i>
        <span>Municipalities</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('provinces')) ? '' : 'collapsed' }}" href="{{route('provinces.index')}}">
          <i class="bi bi-geo-alt-fill"></i>
        <span>Provinces</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('regions')) ? '' : 'collapsed' }}" href="{{route('regions.index')}}">
          <i class="bi bi-globe"></i>
        <span>Regions</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{(request()->is('admin/reports')) ? '' : 'collapsed' }}" href="">
        <i class="bi bi-file-bar-graph"></i>
        <span>Reports</span>
      </a>
    </li><!-- End Blank Page Nav -->
  
  </ul>
  
  </aside><!-- End Sidebar-->
  