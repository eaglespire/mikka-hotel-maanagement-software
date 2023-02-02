<div class="card card-body" wire:key="settings-darklogo-uploads-dhdywgd-9998-hye">
    <p class="text-muted m-b-30">Logo(Dark Version)</p>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Logo(Dark)</label>
        <div class="col-sm-10">
            @if(!empty($darkLogo))
                <div class="my-2">
                    <img  height="64"  src="{{ $darkLogo }}" alt="favicon image">
                </div>
            @endif

            @if($logo)
                <img height="64"  src="{{ $logo->temporaryUrl() }}" alt="favicon image">
            @endif
            <div class="custom-file">
                <input wire:model="logo" type="file" class="custom-file-input @error('logo') is-invalid @enderror"
                       id="customFile">
                <small class="text-muted">Recommended Logo size is 520px by 80px</small>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            @error('logo')
            <span class="m-b-30 text-danger">{{ $message }}</span>
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
                    title: 'Upload Logo?',
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
                    title: 'Success',
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


