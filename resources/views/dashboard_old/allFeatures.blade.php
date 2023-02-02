@extends('layouts.backEnd')

@section('title','All features')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">All Features</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-20">
            <a href="{{ route('b-feature.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fas fa-plus"></i> Add Feature</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                    <tr>
                        <th style="width:10%;">S/N</th>
                        <th style="width:10%;">Icon</th>
                        <th style="width:10%;">Feature</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href=""><i class="fas fa-pencil-alt
                                    m-r-5"></i>
                                            Manage</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_room"><i
                                                class="fas fa-trash-alt m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
