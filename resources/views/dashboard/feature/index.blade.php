@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-body">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('b-add-feature') }}" class="btn btn-primary">Add new feature</a>
                </div>
                @if(count($features) !== 0)
                    <div class="table-responsive">
                        <table class="table table-sm m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Image</th>
                                <th colspan="3">Action</th>
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
                                        <td>image</td>
                                        <td>
                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-center">
                                                <i class="fas fa-plus-square"></i>  Add to pricing
                                            </a>
                                            <a data-toggle="modal" data-target="#editFeature_{{ $feature->id }}" href="" class="btn btn-info">
                                                <i class="fas fa-edit"></i>  edit
                                            </a>
                                            <a data-toggle="modal" data-target="#removeFeature_{{ $feature->id }}" href="" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>  delete
                                            </a>
                                        </td>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
