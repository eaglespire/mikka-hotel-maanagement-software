{{--    Open up a modal--}}
<div class="custom-modal" x-show="modalOpen" x-cloak>
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <span class="c-close" x-on:click="modalOpen=false">&times;</span>
            <h3>New Role</h3>
        </div>
        <div class="custom-modal-body">
            @if(session('modelCreated'))
                <div class="alert alert-primary" role="alert">
                    {{ session('modelCreated') }}
                </div>
            @endif
            <form wire:submit.prevent="addRole">
                <div class="form-group">
                    <label for="" class="form-label">Name</label>
                    <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name of role">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button x-on:click="modalOpen=false" class="btn btn-secondary">Close</button>
            </form>
        </div>

    </div>
</div>
