<div class="card card-body" wire:key="settings-contact-information-3546hdgy-447">
    <p class="text-muted m-b-30">Contact Information Settings</p>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number 1</label>
        <div class="col-sm-10">
            <input class="form-control @error('firstPhoneNumber') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="firstPhoneNumber" placeholder="phone 1"
            >
            @error('firstPhoneNumber')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number 2</label>
        <div class="col-sm-10">
            <input class="form-control @error('secondPhoneNumber') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="secondPhoneNumber" placeholder="phone 2"
            >
            @error('secondPhoneNumber')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Address 1</label>
        <div class="col-sm-10">
            <input class="form-control @error('firstAddress') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="firstAddress" placeholder="Address"
            >
            @error('firstAddress')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Address 2</label>
        <div class="col-sm-10">
            <input class="form-control @error('secondAddress') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="secondAddress" placeholder="Second address"
            >
            @error('secondAddress')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Email 1</label>
        <div class="col-sm-10">
            <input class="form-control @error('firstEmail') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="firstEmail" placeholder="email"
            >
            @error('firstEmail')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Email 2</label>
        <div class="col-sm-10">
            <input class="form-control @error('secondEmail') is-invalid @enderror"
                   id="example-text-input" wire:model.defer="secondEmail" placeholder="second email"
            >
            @error('secondEmail')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row justify-content-end">
        <button wire:click.prevent="$emit('save')" class="btn btn-primary" type="submit">Save Changes</button>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function (){
            @this.on('save', event => {
                Swal.fire({
                    title: 'Save Changes?',
                    icon: 'question',
                    showCancelButton : true,
                    confirmButtonText: 'Yes'
                }).then(result => {
                    if(result.isConfirmed){
                        @this.call('SaveChanges')
                    }
                })
            })
            @this.on('changes-saved', event => {
                Swal.fire({
                    title: 'Changes saved',
                    icon: 'Success'
                })
            })
            @this.on('changes-not-saved', event => {
                Swal.fire({
                    title: 'An error occurred',
                    icon: 'warning'
                })
            })
            @this.on('no-internet', event => {
                Swal.fire({
                    title: 'Ooops!!!, weak or no internet',
                    icon: 'error'
                })
            })
        })
    </script>
@endpush
