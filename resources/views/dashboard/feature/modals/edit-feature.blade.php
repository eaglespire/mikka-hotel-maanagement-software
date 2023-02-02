<!-- Edit Feature Modal -->
<div class="modal fade"  id="editFeature_{{ $feature->id }}" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit {{ $feature->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('b-update-room-feature',$feature->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="" class="form-label">Feature Name</label>
                        <input value="{{ $feature->name }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name of feature">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Feature Image(Optional)</label>
                        <input type="file" class="form-control-file">
                    </div>
                    <div>
                        @error('icon')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                       <p class="p-2 bg-secondary"> Currently chosen icon: <i class="{{ $feature->icon }} text-warning"></i> <span class="text-warning">{{ $feature->icon }}</span></p>
                    </div>
                    <div class="row">
                        @include('dashboard.feature.icons')
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Update</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('scripts')

@endpush


