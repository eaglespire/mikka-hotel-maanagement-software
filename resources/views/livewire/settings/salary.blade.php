<div wire:key="tax-{{ Str::random() }}">
    <x-back-button header-title="Tax settings">
        <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
            <i class="ion ion-md-create"></i> New
        </a>
    </x-back-button>
     <div class="card">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-sm m-0">
                     <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Value(%)</th>
                            <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                         @if(count($taxes) !== 0)
                             @foreach($taxes as $tax)
                                 <tr wire:key="tax-{{ $tax['id'] }}">
                                     <td>{{ $loop->iteration }}</td>
                                     <td>{{ $tax['name'] }}</td>
                                     <td>{{ $tax['value'] }}</td>
                                     <td>
                                         <div class="d-flex">
                                             <a wire:click.prevent="OpenModal(1,'{{ $tax['id'] }}')" href="" class="btn btn-primary">
                                                 <i class="fas fa-edit"></i> edit
                                             </a>
                                             <a wire:click.prevent="$emit('remove',{{ $tax['id'] }})" href="" class="btn btn-danger ml-2">
                                                 <i class="fas fa-trash-alt"></i> delete
                                             </a>
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
    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input placeholder="name" wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="form-label">Value</label>
                <input placeholder="value" wire:model.defer="value" type="text" class="form-control @error('value') is-invalid @enderror">
                @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div wire:loading.delay wire:target="Save" class="text-primary">Processing...</div>


            <button wire:click.prevent="@if($mode == 0) Save @else Update @endif" type="submit" class="btn btn-primary">{{ $btnText }}</button>
        </form>
    </x-custom>
</div>

@push('scripts')
    <script>
        window.addEventListener('livewire:load', function (){
            @this.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message
                })
            })
            @this.on('fail', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                })
            })
            @this.on('remove', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Want to delete?',
                    text: 'This action cannot be reversed',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed'
                }).then(response => {
                        if(response.isConfirmed){
                            @this.call('Remove',id)
                        }
                    })
            })
        })
    </script>
@endpush
