<div class="card card-body" wire:key="settings-social-fteyh-wyet-373-dhdy">
    <p class="text-muted m-b-30">Social Media Accounts</p>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Twitter ID</label>
        <div class="col-sm-10">
            <input  class="form-control @error('twitterID') is-invalid @enderror"
                   id="example-text-input" placeholder="e.g https://twitter.com/example" wire:model.defer="twitterID"
            >
            @error('twitterID')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Facebook ID</label>
        <div class="col-sm-10">
            <input  class="form-control @error('facebookID') is-invalid @enderror"
                   id="example-text-input" placeholder="e.g https://facebook.com/example" wire:model.defer="facebookID"
            >
            @error('facebookID')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Instagram ID</label>
        <div class="col-sm-10">
            <input class="form-control @error('instagramID') is-invalid @enderror"
                   id="example-text-input" placeholder="e.g https://instagram.com/example" wire:model.defer="instagramID"
            >
            @error('instagramID')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Linkedin ID</label>
        <div class="col-sm-10">
            <input  class="form-control @error('twitterID') is-invalid @enderror"
                   id="example-text-input" placeholder="e.g https://linkedin.com/example" wire:model.defer="linkedinID"
            >
            @error('linkedinID')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Youtube ID</label>
        <div class="col-sm-10">
            <input class="form-control @error('youtubeID') is-invalid @enderror"
                   id="example-text-input" placeholder="e.g https://youtube.com/example" wire:model.defer="youtubeID"
            >
            @error('youtubeID')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Whatsapp</label>
        <div class="col-sm-10">
            <input class="form-control @error('whatsapp') is-invalid @enderror"
                   id="example-text-input" placeholder="+44 76890 3547" wire:model.defer="whatsapp"
            >
            @error('whatsapp')
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
