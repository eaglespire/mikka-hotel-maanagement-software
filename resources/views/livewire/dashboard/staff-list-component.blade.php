<div wire:key="staff-list-component">
    @include('flash.loading')
    @include('flash.error',['errorFlash' => 'error'])
    @include('flash.success',['successFlash' => 'success'])
    <div class="row align-items-center my-2">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label>Search for a staff by staff id, name, email or role</label>
                <div wire:offline>
                    <div class="alert alert-danger my-2">
                        You are offline
                    </div>
                </div>
                <input placeholder="search..." wire:offline.attr="disabled" wire:model.defer="searchTerm" class="form-control" type="text">
            </div>
        </div>
        <div class="col-md-3 col-6">
            <a style="margin-top: 10px; padding-bottom: 10px;padding-top: 10px;" wire:click.prevent="searchList" href="#" class="btn btn-success btn-block"> Search </a>
        </div>
        <div class="col-md-3 col-6">
            <a style="margin-top: 10px; padding-bottom: 10px;padding-top: 10px;" wire:click.prevent="refreshList" href="#" class="btn btn-primary
            btn-block">
                Refresh List </a>
        </div>
    </div>
    @if(!isset($employees) || count($employees) === 0)
        <div class="card card-body">
            <p>No results found</p>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th style="min-width:200px;">Name</th>
                            <th>Staff ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th style="min-width: 110px;">Join Date</th>
                            <th>Role</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    @if(!empty($employee->photo))
                                        <img width="28" height="28" src="{{ asset('storage/users/'.$employee->photo) }}"
                                             class="rounded-circle"
                                             alt="">
                                    @else
                                        <img width="28" height="28" src="{{ asset('storage/users/user.jpg') }}"
                                             class="rounded-circle"
                                             alt="">
                                    @endif

                                    <h2>{{ $employee->fullname }}</h2>
                                </td>
                                <td>{{ $employee->staff_identity }}</td>
                                <td><a href="mailto:{{ $employee->email }}" class="__cf_email__"
                                       >{{ $employee->email }}</a></td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->join_date?->toFormattedDateString() }}</td>
                                <td>
                                    <span class="custom-badge status-green">
                                        @if(!empty(sizeof($employee->roles) !== 0))
                                            {{ $employee->roles[0]['name'] }}
                                        @else
                                            null
                                        @endif
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                                class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('b-edit-staff-page',$employee->id) }}"><i class="fas
                                            fa-pencil-alt
                                            m-r-5"></i> Edit</a>
                                            <a wire:click.prevent="launchDeleteModal({{ $employee->id }})" class="dropdown-item" href="#">
                                                <i class="fas fa-trash-alt m-r-5"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    @endif

    <div id="delete-staff" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Employee?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button wire:click.prevent="removeStaff" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('launch-delete-modal', event=>{
            $('#delete-staff').modal('show')
        })
        window.addEventListener('close-modal', event=>{
            $('#delete-staff').modal('hide')
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
        })
    </script>
@endpush
