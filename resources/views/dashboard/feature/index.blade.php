@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col">
            <x-back-button header-title="All Features">
                @can(\App\Services\Permissions::CAN_CREATE_ROOM_FEATURES)
                    <a href="{{ route('b-add-feature') }}" class="btn btn-primary">Add new feature</a>
                @endcan
            </x-back-button>
            <div class="card card-body">
                @if(count($features) !== 0)
                    <div class="table-responsive">
                        <table class="table table-sm m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Icon</th>
                                @can(\App\Services\Permissions::CAN_CREATE_ROOM_FEATURES)
                                    <th colspan="3">Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($features as $feature)
                                    @include('dashboard.feature.modals.edit-feature')
                                    @include('dashboard.feature.modals.delete-feature')
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $feature->name }}</td>
                                        <td>
                                            <i class="{{ $feature->icon }}"></i>
                                        </td>
                                        @can(\App\Services\Permissions::CAN_CREATE_ROOM_FEATURES)
                                            <td>
                                                <div class="d-flex">
                                                    @can(\App\Services\Permissions::CAN_UPDATE_ROOM_FEATURES)
                                                        <a data-toggle="modal" data-target="#editFeature_{{ $feature->id }}" href="" class="btn
                                                        btn-info mr-2">
                                                            <i class="fas fa-edit"></i>  edit
                                                        </a>
                                                    @endcan

                                                    @can(\App\Services\Permissions::CAN_DELETE_ROOM_FEATURES)
                                                        <a data-toggle="modal" data-target="#removeFeature_{{ $feature->id }}" href="" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>  delete
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @else
                    <p class="text-muted">No data to display</p>
                @endif

            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Center modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="" class="form-label">
                                Choose
                            </label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- modal -->

@endsection
