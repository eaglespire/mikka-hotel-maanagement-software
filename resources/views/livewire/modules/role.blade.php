<div wire:key="role-{{ Str::random() }}">
    <x-back-button header-title="New Role">
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($roles) !== 0)
                            @foreach($roles as $role)
                                <tr title="Manage {{ $role['name'] }} Permissions" style="cursor: pointer;" wire:click.stop="OpenPermissionsModal
                                ({{ $role['id'] }},'{{ $role['name'] }}')">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role['name'] }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button wire:click.stop="OpenModal(1,'{{ $role['id'] }}')" class="btn btn-primary mr-1">
                                                <i class="fas fa-edit"></i> edit
                                            </button>
                                            <button wire:click.stop="$emit('remove-role',{{ $role['id'] }})" class="btn btn-danger">
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
    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input placeholder="name" wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div wire:loading.block class="text-primary">Processing...</div>

            <button wire:click.prevent="@if($mode == 0) Save @else Update @endif" type="submit" class="btn btn-primary">
                {{ $btnText }}
            </button>
        </form>
    </x-custom>

    <x-permissions :modal-header="$modalPermissionsHeader">
        <div class="card-body">
            <h4 class="mt-0 header-title">Permissions for {{ $roleName }}</h4>
            <div class="d-flex align-items-center flex-wrap">
                @if(isset($rolePermissions) && count($rolePermissions) !== 0)
                    @foreach($rolePermissions as $permission)
                        <div wire:click.prevent="RevokePermission({{ $permission['id'] }})" class="w-25 alert alert-success bg-success text-white
                        mx-2
                        fade show"
                             role="alert">
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ $permission['name'] }}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body mt-1">
            <h4 class="mt-0 header-title">Add New Permissions</h4>
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                @if(count($permissions) !== 0)
                    @foreach($permissions as $permission)
                        <div wire:click.prevent="$emit('add-permission', {{ $permission['id'] }})" class="w-25 alert alert-primary bg-primary text-white fade show mx-2" role="alert">
                            <button  type="button" class="close"
                                    aria-label="Close">
                                <span aria-hidden="true">+</span>
                            </button>
                            <strong>{{ $permission['name'] }}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </x-permissions>
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
            @this.on('remove-role', id => {
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
            @this.on('add-permission', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Add this permission?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed'
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('AddPermission',id)
                    }
                })
            })
        })
    </script>
@endpush
