<div class="row" wire:key="pages-about-{{ Str::random() }}">
    <div class="col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="ti-angle-left"></i> Back
            </a>
        </div>
        <div class="card card-body">
            <p class="text-muted m-t-30">SEO Settings</p>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="title">
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <input wire:model.defer="description" type="text" class="form-control @error('description') is-invalid @enderror"
                               placeholder="description">
                        @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    @include('includes.processing',['action' => 'SeoSettings'])
                    <button wire:click.prevent="SeoSettings" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <div class="card card-body">
            <p class="text-muted m-t-30">First Section</p>
            <div class="form-row my-2">
                <div class="col-12 col-lg-4">
                    @include('includes.file-preview',['image' => $heroImage,'imagePreview' => $heroImagePreview])
                    @error('heroImagePreview')
                        <div class="m-b-30 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="" class="form-label">Hero Image</label>
                        <div class="custom-file">
                            <input wire:model="heroImagePreview" type="file" class="custom-file-input @error('heroImagePreview') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    @include('includes.processing',['action' => 'UploadHeroImage'])
                    <button wire:click.prevent="UploadHeroImage" type="submit" class="btn btn-primary">Upload</button>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    @include('includes.file-preview', ['image' => $firstSectionFirstImage,'imagePreview' => $firstSectionFirstImagePreview])

                    @error('firstSectionFirstImagePreview')
                        <div class="m-b-30 text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="" class="form-label">First Section Image(1)</label>
                        <div class="custom-file">
                            <input wire:model="firstSectionFirstImagePreview" type="file"
                                   class="custom-file-input @error('firstSectionFirstImagePreview') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    @include('includes.processing',['action' => 'UploadFirstSectionFirstImage'])
                    <button wire:click.prevent="UploadFirstSectionFirstImage" type="submit" class="btn btn-primary">Upload</button>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    @include('includes.file-preview', ['image' => $firstSectionSecondImage,'imagePreview' => $firstSectionSecondImagePreview])

                    @error('firstSectionSecondImagePreview')
                        <div class="m-b-30 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="" class="form-label">First Section Image(2)</label>
                        <div class="custom-file">
                            <input wire:model="firstSectionSecondImagePreview"
                                   type="file"
                                   class="custom-file-input @error('firstSectionSecondImagePreview') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    @include('includes.processing',['action' => 'UploadFirstSectionSecondImage'])
                    <button wire:click.prevent="UploadFirstSectionSecondImage" type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
            <hr>
            <div class="form-row my-2">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="firstSectionTitle" type="text" class="form-control" placeholder="first section title">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">SubTitle</label>
                        <input wire:model.defer="firstSectionSubTitle" type="text" class="form-control" placeholder="first section subtitle">
                    </div>
                </div>

            </div>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="form-label">Body(1)</label>
                        <textarea wire:model.defer="firstSectionBody" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" class="form-label">Body(2)</label>
                        <textarea wire:model.defer="firstSectionBodyTwo" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    @include('includes.processing',['action' => 'SaveFirstSectionData'])
                    <button wire:click.prevent="SaveFirstSectionData" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <p class="text-muted m-t-30">Second Section</p>
            <div class="form-row my-2">
                <div class="col-12 col-lg-6">
                    @include('includes.file-preview', ['image' => $secondSectionImage,'imagePreview' => $secondSectionImagePreview])

                    @error('secondSectionImagePreview')
                    <div class="m-b-30 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="" class="form-label">Image</label>
                        <div class="custom-file">
                            <input wire:model="secondSectionImagePreview" type="file" class="custom-file-input @error('secondSectionImagePreview') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    @include('includes.processing',['action' => 'UploadSecondSectionImage'])
                    <button wire:click.prevent="UploadSecondSectionImage" type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
            <div class="form-row my-2">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="secondSectionTitle" type="text" class="form-control" placeholder="title(second section)">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label">SubTitle</label>
                        <input wire:model.defer="secondSectionSubtitle" type="text" class="form-control" placeholder="subtitle(second section)">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Body</label>
                        <textarea wire:model.defer="secondSectionBody" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col">
                    @include('includes.processing',['action' => 'SaveSecondSectionData'])
                    <button wire:click.prevent="SaveSecondSectionData" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <p class="text-muted m-t-30">Third Section</p>
            <div class="form-row my-2">
                <div class="col">
                    @include('includes.file-preview', ['image' => $thirdSectionImage,'imagePreview' => $thirdSectionImagePreview])

                    @error('thirdSectionImagePreview')
                        <div class="m-b-30 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="" class="form-label">Image</label>
                        <div class="custom-file">
                            <input wire:model="thirdSectionImagePreview" type="file" class="custom-file-input @error('thirdSectionImagePreview') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    @include('includes.processing',['action' => 'UploadThirdSectionImage'])
                    <button wire:click.prevent="UploadThirdSectionImage" type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
            <div class="form-row my-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="thirdSectionTitle" type="text" class="form-control" placeholder="title(3rd section)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="form-label">SubTitle</label>
                        <input wire:model.defer="thirdSectionSubTitle" type="text" class="form-control" placeholder="subtitle(3rd section)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="form-label">Button Text</label>
                        <input wire:model.defer="thirdSectionButtonText" type="text" class="form-control" placeholder="btn text">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="form-label">Link to</label>
                        <select wire:model="thirdSectionButtonUrl" class="form-control">
                            <option disabled>Please choose</option>
                            <option value="/">Home Page</option>
                            <option value="/contact">Contact Page</option>
                            <option value="/facilities">Facilities Page</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Body(1)</label>
                        <textarea wire:model.defer="thirdSectionFirstBody" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Body(2)</label>
                        <textarea wire:model.defer="thirdSectionSecondBody" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    @include('includes.processing',['action' => 'SaveThirdSectionData'])
                    <button wire:click.prevent="SaveThirdSectionData" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            @this.
            on('seo', event => {
                Swal.fire({
                    title: 'Save Changes?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(result => {
                    if (result.isConfirmed) {
                        @this.
                        call('SeoSettings')
                    }
                })
            })
            @this.on('upload-hero-image', event => {
                Swal.fire({
                    title: 'Upload?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(result => {
                    if (result.isConfirmed) {
                        @this.
                        call('UploadHeroImage')
                    }
                })
            })
            @this.on('changes-saved', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Changes saved'
                })
            })
            @this.on('changes-not-saved', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred'
                })
            })
            @this.on('no-internet', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'No/Weak Internet'
                })
            })
        })
    </script>
@endpush
