<div wire:key="assign-or-revoke-role">
    <div class="card card-body">
        <div class="p-2">
            @include('flash.success',['successFlash' => 'roleRevoked'])
        </div>
        @if(!$showRoles && sizeof($user->roles) !== 0)
            <p>Current role: {{ ucfirst($user->roles[0]['name']) }}
                <button wire:click.prevent="launchModal({{ $user->roles }})" class="ml-1 btn btn-primary btn-sm">Remove role</button>
            </p>
        @else
            <div>
                @if(!empty($roles) && count($roles) !== 0)
                    @foreach($roles as $role)
                        <button wire:click.prevent="launchAssignRoleModal({{$role}})" class="btn btn-success m-2">
                            Assign {{ ucfirst($role->name) }} Role
                        </button>
                    @endforeach
                @endif
            </div>
        @endif

    </div>
    <div id="revoke-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to revoke this staff role?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="revokeRole" type="submit" class="btn btn-danger">Revoke</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="assign-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
{{--                    <img src="/assets/img/sent.png" alt="" width="50" height="46">--}}
                    <h3>Proceed?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="assignRole" type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('open-modal', event=>{
            $('#revoke-role').modal('show')
        })
        window.addEventListener('close-modal', event=>{
            $('#revoke-role').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
        })
        window.addEventListener('launch-assign-modal', event=>{
            $('#assign-role').modal('show')
        })
        window.addEventListener('close-assign-modal', event=>{
            $('#assign-role').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
        })
    </script>
@endpush
