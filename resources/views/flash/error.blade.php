@if(session($errorFlash))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session($errorFlash) }}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
