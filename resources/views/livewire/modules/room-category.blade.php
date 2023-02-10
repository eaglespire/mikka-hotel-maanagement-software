<div class="row mb-5" wire:key="pricing-{{ Str::random() }}">
    <div class="col-12">
        <x-back-button header-title="Room Categories">
            @can(\App\Services\Permissions::CAN_CREATE_ROOMS)
                @if(count($roomFeatures) == 0)
                    <a href="{{ route('b-add-feature') }}" class="btn btn-success">
                        <i class="ion ion-md-create"></i> Please add some features before continuing
                    </a>
                @else
                    <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
                        <i class="ion ion-md-create"></i> New
                    </a>
                @endif
            @endcan
        </x-back-button>
    </div>
    <div class="col-12 my-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm m-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Tag</th>
                            <th>Rooms</th>
                            <th>Features</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($pricing) !== 0)
                            @foreach($pricing as $item)
                                <tr title="View {{ $item['title'] }}" style="cursor: pointer;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['subtitle'] ?? 'NA' }}</td>
                                    <td>{{ $item['tag'] ?? 'NA' }}</td>
                                    <td>{{ count($item->rooms) }}</td>
                                    <td>{{ count($item->features) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button wire:click.stop="OpenModal(1,'{{ $item['id'] }}')" class="btn btn-primary mr-1">
                                                <i class="fas fa-edit"></i> edit
                                            </button>
                                            <button wire:click.stop="$emit('remove-role',{{ $item['id'] }})" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> remove
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-row">
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input wire:model.defer="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               placeholder="enter title">
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="" class="form-label">Subtitle</label>
                        <input wire:model.defer="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror"
                               placeholder="enter subtitle">
                        @error('subtitle')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
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
            </div>
            <div class="form-row my-2">
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
                <div class="col-12 my-2">
                    @if($mode === 0)
                        <button class="btn btn-primary" wire:click.prevent="SavePricingData">Save</button>
                    @else
                        <button class="btn btn-primary" wire:click.prevent="UpdatePricing">Update</button>
                    @endif
                    <div wire:loading.block wire:target="SavePricingData,UpdatePricing" class="alert alert-info mt-2">Processing...</div>
                </div>
            </div>
        </form>
    </x-custom>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
            @this.on('success', () => {
                Swal.fire({
                    icon:'success',
                    title:'Success',
                })
            })
            @this.on('fail', () => {
                Swal.fire({
                    icon:'error',
                    title:'Error',
                })
            })
            @this.on('remove-role', id => {
                Swal.fire({
                    icon:'question',
                    title:'Delete this category?',
                    showCancelButton: true,
                    confirmButtonColor:'#EC4561'
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeletePricing',id)
                    }
                })
            })

        })
    </script>
@endpush
