@extends('layouts.app')

@section('page-title', 'Organizational Structure')

@section('content')

<div class="container mt-5">

   <!-- SK Organizational Structure -->
   <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-center">
            <h2>SK Organizational Structure</h2>
        </div>
    </div>
    
    <!-- First row -->
    <div class="row justify-content-center">
        @if(isset($officials[0]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials->first()->avatar ? asset('storage/' . $officials->first()->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials->first()->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials->first()->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Second row -->
    <div class="row justify-content-center mt-2">
        @if(isset($officials[1]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[1]->avatar ? asset('storage/' . $officials[1]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[1]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[1]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[2]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[2]->avatar ? asset('storage/' . $officials[2]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[2]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[2]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[3]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[3]->avatar ? asset('storage/' . $officials[3]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[3]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[3]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Third row -->
    <div class="row justify-content-center mt-2">
        @if(isset($officials[4]))
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[4]->avatar ? asset('storage/' . $officials[4]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[4]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[4]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[5]))
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[5]->avatar ? asset('storage/' . $officials[5]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 1; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[5]->name }}</p>                    
                    <p class="card-text" style="line-height: 1;">{{ $officials[5]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[6]))
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[6]->avatar ? asset('storage/' . $officials[6]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[6]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[6]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[7]))
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[7]->avatar ? asset('storage/' . $officials[7]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[7]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[7]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Fourth row -->
    <div class="row justify-content-center mt-2">
        @if(isset($officials[8]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[8]->avatar ? asset('storage/' . $officials[8]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[8]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[8]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(isset($officials[9]))
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $officials[9]->avatar ? asset('storage/' . $officials[9]->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Avatar" class="rounded-circle mb-3 mt-3" width="100">
                    <p class="card-text" style="line-height: 0; color: darkblue; font-weight: bold; white-space: normal;">{{ $officials[9]->name }}</p>
                    <p class="card-text" style="line-height: 1;">{{ $officials[9]->position->name }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
