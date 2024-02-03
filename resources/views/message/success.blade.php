@if (Session::has('success'))
    


<div class="alert alert-success alert-dismissible fade show" role="alert">
    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button> -->
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{-- <strong>Success!</strong> {{ Session::get('success')}} --}}
    {{ Session::get('success')}}
</div>


@endif
