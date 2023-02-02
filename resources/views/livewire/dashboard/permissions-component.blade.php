<div wire:key="permissions-component">
    <div class="row">
        <div class="col-12">
            @include('flash.success',['successFlash' => 'revokeSuccess'])
            @if(sizeof($role->permissions) !== 0)
                <h6 class="card-title m-b-20">{{ ucfirst($role->name) }} Role Access</h6>
                <div class="m-b-30">
                    <ul class="list-group">
                        @foreach($role->permissions as $permission)
                            <li class="list-group-item">
                                {{ $permission->name }}
                                <div class="float-right">
                                    <button wire:click.prevent="revokePermission({{ $permission }})" class="btn btn-primary">
                                        Revoke Permission
                                    </button>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @else
                <div class="card card-body">
                    <h4>{{ ucfirst($role->name) }} role has no set permissions</h4>
                </div>
            @endif


        </div>
        <div class="col-12 mt-30">
            <h6 class="card-title m-b-20">Available Permissions</h6>
            @include('flash.success',['successFlash' => 'success'])
            @include('flash.error',['errorFlash' => 'error'])
            <div class="m-b-30">
                @if(!empty($permissions) && count($permissions) !== 0)
                    <ul class="list-group">
                        @foreach($permissions as $permission)
                            <li class="list-group-item" wire:key="{{ $permission->id }}">
                                {{ $permission->name }}
                                <div class=" float-right">
                                    <input wire:model="checkedPermissions" id="staff_module" type="checkbox" value="{{ $permission->name }}">
                                    <label for="staff_module" class="badge-success"></label>
                                </div>
                            </li>
                        @endforeach
                        <li>{{ var_export($checkedPermissions) }}</li>
                    </ul>
                    <button wire:click.prevent="saveCheckedPermissions" class="btn btn-primary btn-block">
                        Save
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>
