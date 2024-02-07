@extends('layouts.app')

@section('page-title', 'User Profile')

@section('content')

@include('message.success')
@include('message.error')
  


    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              {{-- <img src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle"> --}}
              <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle">

              <h2>{{ $user->name }}</h2>
              <h3> 
                  {{ $user->position->name }}
              </h3>
              {{-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> --}}
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                {{-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> --}}

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  {{-- <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> --}}

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$user->name }}</div>
                  </div>

                  {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                  </div>
                   --}}

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Position</div>
                    <div class="col-lg-9 col-md-8">{{ $user->position->name }}</div>
                  </div>

                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Account Type</div>
                    <div class="col-lg-9 col-md-8">            
                     
                      @if (Auth::user()->account_type === 'barangay_user')
                      <span>Barangay {{ Auth::user()->barangay->name }} User</span>
                      @elseif (Auth::user()->account_type === 'barangay_admin') 
                      <span>Barangay {{ Auth::user()->barangay->name }} Admin</span>      
                      @elseif (Auth::user()->account_type === 'municipal_admin') 
                      <span>Municipal Admin</span>
                      @elseif (Auth::user()->account_type === 'provincial_admin') 
                      <span>Provincial Admin</span>
                      @elseif (Auth::user()->account_type === 'super_admin') 
                      <span>Super Admin</span>
                      @endif

      

                    </div>
                  </div>


                  {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">USA</div>
                  </div> --}}

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Barangay</div>
                    <div class="col-lg-9 col-md-8">
                      {{$user->barangay->name}}
                    </div>
                  </div>

                  {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div> --}}

                  {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div> --}}

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{ route('update.profile', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                

                    
                    <div class="row mb-3">
                        <label for="profile_image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                            <div id="profileImageContainer">
                              @if($user->avatar)
                                  <img id="profileImage" src="{{ asset('storage/' . $user->avatar) }}" alt="Profile">
                              @else
                                  <img id="profileImage" src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Profile">
                              @endif
                              
                            </div>
                            <div class="pt-2">
                                <input type="file" name="avatar" accept="image/*" class="d-none" id="profile_image" onchange="previewImage(this)">
                                <label for="profile_image" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></label>
                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="removeProfileImage()"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="{{$user->name }}">
                      </div>
                    </div>

                    {{-- <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                      </div>
                    </div> --}}

                    {{-- <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="Lueilwitz, Wisoky and Leuschke">
                      </div>
                    </div> --}}

                   

                    {{-- <div class="row mb-3">
                      <div class="col-lg-3 col-md-4 label">Position</div>
                      <div class="col-lg-9 col-md-8">
                          <select name="position_id" class="form-control">
                              @foreach ($positions as $position)
                                  <option value="{{ $position->id }}" {{ $position->id === $user->position_id ? 'selected' : '' }}>
                                      {{ $position->name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                    </div> --}}
                    
                    <div class="row mb-3">
                      <label for="position" class="col-md-4 col-lg-3 col-form-label">Position</label>
                      <div class="col-md-8 col-lg-9">
                          <span class="form-control" id="position">
                            {{ $user->position->name }}
                          </span>
                      </div>
                    </div>
              

                    <div class="row mb-3">
                      <label for="account_type" class="col-md-4 col-lg-3 col-form-label">Account Type</label>
                      <div class="col-md-8 col-lg-9">
                          <span class="form-control" id="account_type">
                              @if ($user->account_type === 'barangay_user')
                                  Barangay {{ $user->barangay->name }} User
                              @elseif ($user->account_type === 'barangay_admin') 
                                  Barangay {{ $user->barangay->name }} Admin
                              @elseif ($user->account_type === 'municipal_admin') 
                                  Municipal Admin
                              @elseif ($user->account_type === 'provincial_admin') 
                                  Provincial Admin
                              @elseif ($user->account_type === 'super_admin') 
                                  Super Admin
                              @endif
                          </span>
                      </div>
                  </div>
                  
                  {{-- <div class="row mb-3">
                      <label for="campus_id" class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                      <div class="col-md-8 col-lg-9">
                          <select name="campus_id" class="form-control">
                              @foreach ($barangays as $barangay)
                                  <option value="{{ $barangay->id }}" {{ $barangay->id === $user->barangay_id ? 'selected' : '' }}>
                                      {{ $barangay->name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                  </div> --}}

                  <div class="row mb-3">
                    <label for="barangay" class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                    <div class="col-md-8 col-lg-9">
                        <span class="form-control" id="barangay">
                          {{ $user->barangay->name }}
                        </span>
                    </div>
                  </div>
    
                
                

                    {{-- <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                      </div>
                    </div> --}}

                    {{-- <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                      </div>
                    </div> --}}

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{ $user->email }}">
                      </div>
                    </div>

                    {{-- <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div> --}}

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  {{-- <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form> --}}
                  <!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  

                  <form method="POST" action="{{ route('change-password') }}">
                    @csrf
                
                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="current_password" type="password" class="form-control" id="currentPassword">
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="new_password" type="password" class="form-control" id="newPassword">
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
                

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  
  <script>
    function previewImage(input) {
        var profileImage = document.getElementById('profileImage');
        var profileImageContainer = document.getElementById('profileImageContainer');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                profileImage.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
            profileImageContainer.classList.remove('d-none');
        }
    }

    function removeProfileImage() {
        var profileImage = document.getElementById('profileImage');
        var profileImageContainer = document.getElementById('profileImageContainer');
        var inputFile = document.getElementById('profile_image');

        // Set image source to default
        profileImage.src = '{{ asset("assets/layouts/img/profile-img.png") }}';

        // Clear the input file
        inputFile.value = '';

    }
</script>

@endsection