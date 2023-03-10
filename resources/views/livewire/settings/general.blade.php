<div wire:key="settings-{{ Str::random() }}">
    <div class="d-flex justify-content-between mb-2">
        <h4 class="header-title">{{__("General Settings")}}</h4>
        <div class="d-flex align-items-center">
            <button wire:click="ToggleDropDown" class="btn btn-primary d-flex align-items-center mr-2">
                <i style="font-size: 20px" class="mdi mdi-arrow-down-drop-circle mr-1"></i> <span>{{ __("Manage Settings") }}</span>
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i style="font-size: 20px" class="typcn typcn-chevron-left"></i> Back
            </a>
        </div>
    </div>
    <x-settings-dropdown>
        <a href="{{ route('b-contact-settings') }}">Contact Settings</a>
        <a href="{{ route('b-social-media-settings') }}">Social Media Settings</a>
        <a href="{{ route('b-upload-settings') }}">Uploads</a>
        <a href="{{ route('b-salary-settings') }}">Tax Settings</a>
    </x-settings-dropdown>
    <div class="card card-body" wire:key="general-settings-162647ghfgd">

        <p class="text-muted m-b-30">General Settings</p>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Site Name</label>
            <div class="col-sm-10">
                <input class="form-control @error('siteName') is-invalid @enderror"
                       wire:model.defer="siteName"    id="example-text-input" placeholder="e.g mikka">
                @error('siteName')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">FrontPages Copyright text</label>
            <div class="col-sm-10">
                <input class="form-control @error('frontCopyright') is-invalid @enderror" id="example-text-input"
                       placeholder="copyright text" wire:model.defer="frontCopyright"
                >
                @error('frontCopyrightt')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Dashboard Copyright text</label>
            <div class="col-sm-10">
                <input class="form-control @error('backCopyright') is-invalid @enderror" id="example-text-input"
                       placeholder="copyright text" wire:model.defer="backCopyright"
                >
                @error('backCopyright')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Site header</label>
            <div class="col-sm-10">
                <input class="form-control @error('header') is-invalid @enderror"
                       id="example-text-input" placeholder="site header" wire:model.defer="header" >
                @error('header')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Currency</label>
            <div class="col-sm-10">
                <select wire:model.defer="currency" class="form-control  @error('currency') is-invalid @enderror">
                    <option disabled>Select</option>
                    <option value="USD">USD</option>
                    <option value="NGN">NGN</option>
                    <option value="GBP">GBP</option>
                    <option value="EUR">EUR</option>
                </select>
                @error('currency')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row justify-content-end">
            <button wire:click.prevent="$emit('save')" class="btn btn-primary" type="submit">Save Changes</button>
        </div>
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
