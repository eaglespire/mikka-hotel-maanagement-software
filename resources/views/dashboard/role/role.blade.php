@extends('layouts.backEnd')

@section('content')
    @include('dashboard.role.modals.assign-permissions')
    <div class="row">
        <div class="col-md-6">
            <h6>Permissions for {{ $role->name }}</h6>
            @if($role->permissions->count() !== 0)
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($role->permissions->pluck('name') as $permission)
                                @include('dashboard.role.modals.revoke-permission')
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $permission }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#revokePermission_{{ $permission }}" href="" class="btn btn-danger">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
        <div class="col-md-6">
            <h6>Available Module Permissions</h6>
            @if(count($permissions) !== 0)
                <div class="card card-body">
                    <form id="permissions-form" action="{{ route('b-assign-permission',$role->name) }}" method="post">
                        @csrf
                        @foreach($permissions as $permission)
                            <div class="form-check form-check-inline p-1">
                                <input name="permission[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $permission }}" multiple>
                                <label class="form-check-label" for="inlineCheckbox1">{{ $permission}}</label>
                            </div>
                        @endforeach
                        <button data-toggle="modal" data-target="#assignPermission" type="button" class="btn btn-primary btn-block">Add Selected Permissions</button>
                    </form>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('styles')

@endpush
