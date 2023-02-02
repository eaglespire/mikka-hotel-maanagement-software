@extends('layouts.backEnd')
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <h4 class="page-title">Roles and Permissions</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
            @livewire('dashboard.roles-component')
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
            @section('main')
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="page-title">Permissions</h4>
                            <p>Click on any of the roles to assign permissions to roles or view
                            role permissions</p>
                        </div>
                    </div>
                </div>
            @show

        </div>
    </div>
@endsection
