<div class="row" wire:key="pricing-{{ Str::random() }}">
    <!-- Alpine Modal -->
    <x-pricing :header="$header">
        <form>
            <div class="form-row">
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               placeholder="enter title">
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Subtitle</label>
                        <input wire:model.defer="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror"
                               placeholder="enter subtitle">
                        @error('subtitle')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row my-2">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Tag</label>
                        <input wire:model.defer="tag" type="text" class="form-control @error('tag') is-invalid @enderror"
                               placeholder="enter tag">
                        @error('tag')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Price</label>
                        <input wire:model.defer="price" type="text" class="form-control @error('price') is-invalid @enderror"
                               placeholder="enter price">
                        @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Link to ?</label>
                        <select wire:model.defer="url" id="" class="form-control @error('url') is-invalid @enderror">
                            <option disabled>Please select</option>
                            <option value="/">Home</option>
                            <option value="/about">About</option>
                            <option value="/contact">Contact</option>
                        </select>
                        @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if($mode === 0)
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Select features</label>
                            <select wire:model="features" id="" class="form-control" multiple>
                                @if(isset($roomFeatures))
                                    @foreach($roomFeatures as $feature)
                                        <option value="{{ $feature['id'] }}">{{ $feature['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endif

                @if($mode === 1)
                    <div class="col-12 my-2">
                        @include('includes.processing',['action' => 'UpdatePricing','SavePricingData'])
                        <button class="btn btn-primary" wire:click.prevent="UpdatePricing">Update</button>
                    </div>
                @endif
                @if($mode === 0)
                    <div class="col-12 my-2">
                        <button class="btn btn-primary" wire:click.prevent="SavePricingData">Submit</button>
                    </div>
                @endif
                <div class="form-row my-2">
                    <div class="col-12">
                        @if($image)
                            <div class="my-2">
                                <img src="{{ $image->temporaryUrl() }}" alt="image" width="200" height="100 ">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input wire:model="image" type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose hero image(You only need to do this once)</label>
                        </div>
                        @error('image')
                        <span class="m-b-30 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        @include('includes.processing',['action' => 'UploadImage'])
                        <button wire:click.prevent="UploadImage" class="btn btn-primary my-2">Upload</button>
                    </div>

                </div>
            </div>
        </form>
    </x-pricing>
    <!-- Alpine Modal -->
    <div class="col-12">
        <div class="d-lg-flex justify-content-end my-2">
            <button wire:click.prevent="OpenModal(0)" type="button" class="btn btn-primary waves-effect waves-light">
                Add new  <i class="dripicons-plus"></i>
            </button>
        </div>
    </div>

    @if(count($pricing) !== 0)
        @foreach($pricing as $item)
            <div class="col-xl-3 col-md-6">
                <div class="card pricing-box">
                    <div class="card-body">
                        <div class="mb-4 pt-3 pb-3">
                            <div class="pricing-icon float-left">
                                <i class="ion ion-ios-airplane"></i>
                            </div>
                            <div class="text-right">
                                <h5 class="mt-0">{{ $item['title'] }}</h5>
                                <p class="text-muted">{{ $item['subtitle'] }}</p>
                            </div>
                        </div>
                        @if(isset($item->features) && count($item->features) !== 0)
                            <div class="pricing-features mb-4">
                                @foreach($item->features as $feature)
                                    <p><i class="mdi mdi-check text-primary mr-2"></i> {{ $feature->name }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="text-center pt-3 pb-3">
                            <h2><sup><small>$</small></sup>{{ number_format($item['price']) }}/<span class="font-16">Per month</span></h2>
                        </div>
                        <div class="mt-4">
                            <a
                                x-on:click="hideModal=false"
                               href="#"
                               class="btn btn-primary waves-effect waves-light "
                               wire:click.prevent="OpenModal(1, '{{ $item['id'] }}')"
                            >
                            Edit
                            </a>
                            <a wire:click.prevent="$emit('begin-delete',{{ $item['id'] }})" href="#" class="btn btn-danger  waves-effect
                            waves-light">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        @endforeach
    @endif











</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
            @this.on('changes-saved', () => {
                Swal.fire({
                    icon:'success',
                    title:'Success',
                })
            })
            @this.on('changes-not-saved', () => {
                Swal.fire({
                    icon:'warning',
                    title:'Error',
                })
            })
            @this.on('begin-delete', id => {
                Swal.fire({
                    icon:'question',
                    title:'Delete this pricing?',
                    showCancelButton: true
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeletePricing',id)
                    }
                })
            })
            // $('.bs-example-modal-center').on('hide.bs.modal', function () {
            //     Livewire.emit('clear-errors')
            // })
        })
    </script>
@endpush
