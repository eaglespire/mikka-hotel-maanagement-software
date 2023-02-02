
{{--    Open up a modal--}}
<div class="custom-modal" x-show="editRole" x-cloak>
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <span class="c-close" x-on:click="editRole=false">&times;</span>
            <h3>Edit {{ $name }}</h3>
        </div>
        <div class="custom-modal-body">
            @if(session('modelUpdated'))
                <div class="alert alert-primary" role="alert">
                    {{ session('modelUpdated') }}
                </div>
            @endif
            <form wire:submit.prevent="editRole">
                <div class="form-group">
                    <label for="" class="form-label">Name</label>
                    <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name of role">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <button x-on:click="editRole=false" class="btn btn-secondary">Close</button>
            </form>
        </div>

    </div>
</div>


