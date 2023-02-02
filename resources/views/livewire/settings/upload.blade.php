<div class="card card-body" wire:key="settings-uploads-urujfhj-2737-fjjhye">
    <p class="text-muted m-b-30">Uploads</p>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Favicon</label>
        <div class="col-sm-10">
            @if($favicon)
                <img width="16" height="16"  src="{{ $favicon->temporaryUrl() }}" alt="favicon image">
            @endif
            <div class="custom-file">
                <input wire:model="favicon" type="file" class="custom-file-input @error('favicon') is-invalid @enderror"
                       id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            @error('favicon')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Logo(White)</label>
        <div class="col-sm-10">
            @if($whiteLogo)
                <img width="250" height="150"  src="{{ $whiteLogo->temporaryUrl() }}" alt="favicon image">
            @endif
            <div class="custom-file">
                <input wire:model="whiteLogo" type="file" class="custom-file-input @error('whiteLogo') is-invalid @enderror"
                       id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            @error('whiteLogo')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-sm-2 col-form-label">Logo(Dark)</label>
        <div class="col-sm-10">
            @if($darkLogo)
                <img width="250" height="150"  src="{{ $favicon->temporaryUrl() }}" alt="favicon image">
            @endif
            <div class="custom-file">
                <input wire:model="darkLogo" type="file" class="custom-file-input @error('darkLogo') is-invalid @enderror"
                       id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            @error('darkLogo')
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
        })
    </script>
@endpush
