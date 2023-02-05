@php

@endphp

@extends('layouts.backEnd')
@section('content')
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between my-2">
                <h4 class="mt-0 header-title">All Roles</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center">
                    Add New Role  <i class="typcn typcn-chevron-right"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($roles->isNotEmpty())
                        @foreach($roles as $role)
                            @include('dashboard.role.modals.edit-role')
                            @include('dashboard.role.modals.delete-role')
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ specific_role_users_count($role['id']) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a data-toggle="modal" data-target="#editRole_{{ $role->id }}" href="#" class="btn btn-primary mr-1">
                                            Edit
                                        </a>
                                        <a href="{{ route('b-role',$role->name) }}" class="btn btn-primary mr-1">
                                            Permissions
                                        </a>
                                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#removeRole_{{ $role->id }}">
                                            Delete
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

    <!-- New Role Modal -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add new role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('b-add-role') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Name</label>
                            <input name="name" value="{{ old('name') }}" placeholder="new role" type="text"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Add
                        </button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">
                            Cancel
                        </button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection

@push('scripts')
    <script>
        @if(count($errors) > 0)
        $('.bs-example-modal-center').modal('show');
        @endif
    </script>
@endpush
