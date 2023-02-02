<div wire:key="b-roles-component">
    <a data-toggle="modal" data-target="#new-role" href="#" class="btn btn-primary btn-block">
        <i class="fas fa-plus"></i> Add Role
    </a>
    @if(!empty($roles))
        <div class="roles-menu">
            <div wire:loading.block wire:target="removeRole">
                <div class="alert alert-primary">Processing...</div>
            </div>
            @include('flash.success',['successFlash' => 'success'])
            @include('flash.error',['errorFlash' => 'error'])
            <ul>
                @foreach($roles as $role)
                    <li class="make-active">
                        <a href="{{ route('b-permissions-component',['role'=>$role]) }}">{{ $role->name }}</a>
                        <span class="role-action">
                        <a wire:click.prevent="launchEditModal({{$role->id }})" href="#">
                            <span class="action-circle large">
                                <i class="material-icons">edit</i>
                            </span>
                        </a>
                    <a wire:click.prevent="launchDeleteModal({{ $role->id }})" href="#">
                        <span class="action-circle large delete-btn">
                            <i class="material-icons">delete</i>
                        </span>
                    </a>
                </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p>No data...</p>
    @endif

    <!-- Show Role Modal -->
    <div id="show-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>{{ $showRole }}</h3>
                    <h6 class="card-title m-b-20">Permissions</h6>
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th>Module Permission</th>
                                <th>First Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1</td>
                                    <td class="text-center">
                                        <input type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="updateRole" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Role Modal -->

    <!-- New Role Modal -->
    <div id="new-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>New Role</h3>
                    <form>
                        <div class="form-group">
                            <label for="" class="form-label">Role</label>
                            <input wire:model.defer="name" type="text" class="form-control">
                        </div>
                    </form>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="addRole" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Role Modal -->

    <!-- Edit Role Modal -->
    <div id="edit-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>Edit {{$name}}</h3>
                    <form>
                        <div class="form-group">
                            <label for="" class="form-label">Role</label>
                            <input wire:model.defer="name" type="text" class="form-control">
                        </div>
                    </form>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="updateRole" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Role Modal -->

    <!-- Delete Modal -->
    <div id="delete-role" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this role?</h3>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="removeRole" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

</div>



@push('styles')
    <link rel="stylesheet" href="{{ asset('c-modal.css') }}">
    <style>
        .make-active:hover,.make-active:focus{
            background-color: orangered !important;
            color: #fefefe;
        }
    </style>
@endpush

@push('scripts')
    <script>
        window.addEventListener('close-modal', event=>{
            $('#new-role').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
        })
        window.addEventListener('open-delete-modal', event=>{
            $('#delete-role').modal('show')
        })
        window.addEventListener('close-delete-modal', event=>{
            $('#delete-role').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove()
        })
        window.addEventListener('open-edit-modal', event=>{
            $('#edit-role').modal('show')
        })
        window.addEventListener('close-edit-modal', event=>{
            $('#edit-role').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
        })
        window.addEventListener('open-show-modal', event=>{
            $('#show-role').modal('show')
        })

    </script>
@endpush

