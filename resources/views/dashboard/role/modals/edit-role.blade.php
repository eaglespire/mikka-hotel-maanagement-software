<!-- Edit Role Modal -->
<div class="modal fade"  id="editRole_{{ $role->id }}" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit {{ $role->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('b-update-role',$role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input id="name" name="name" value="{{ $role->name }}" placeholder="new role" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        Update
                    </button>
                    <button data-dismiss="modal" type="button" class="btn btn-secondary waves-effect waves-light">
                        Cancel
                    </button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('scripts')

@endpush


