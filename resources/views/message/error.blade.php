@if ($errors->any())
    
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button> -->
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Failed!</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
            
        @endforeach
    </ul>
</div>

@endif