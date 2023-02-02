@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">All Rooms</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-20">
            <a href="{{ route('b-room.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fas fa-plus"></i> Add Room</a>
        </div>
    </div>
    @livewire('dashboard.all-rooms-component')
@endsection
