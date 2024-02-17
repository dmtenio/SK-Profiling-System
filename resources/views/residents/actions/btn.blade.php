<div class="btn-group" role="group" aria-label="Action Group">
    <a href="{{ route('residents.edit', $youth->id) }}" class="btn btn-primary btn-sm float-start">
        <i class="bi bi-pencil-square"></i>
    </a>
    <!-- Button trigger delete modal -->
    <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modelIdDelete-{{$youth->id}}">
        <i class="bi bi-trash3"></i>
    </button>
</div>

<!-- Modal for delete -->
<div class="modal fade" id="modelIdDelete-{{$youth->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('residents.destroy', $youth->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="modal-body">
                        Are you sure to delete Youth: <strong>{{$youth->last_name}}, {{$youth->first_name}}@if($youth->middle_name) {{$youth->middle_name}}@endif @if($youth->suffix), {{$youth->suffix}}@endif
                        </strong> ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>