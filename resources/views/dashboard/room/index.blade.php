@php
        $routeName = route('b-add-room');
@endphp

@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @can(\App\Services\Permissions::CAN_CREATE_ROOM)
                        <div class="d-flex m-b-30 justify-content-between align-items-center">
                            <h4 class="mt-0 header-title">All Rooms</h4>
                            <x-top-right-btn :route="$routeName" title="Add new room" icon="right" />
                        </div>
                    @endcan
                    <div class="table-responsive">
                        <table class="table table-sm m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Rm No</th>
                                <th>Status</th>
                                <th>Availability</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @if($items->total() > 0)
                                <tbody>
                                    @foreach($items as $room)
                                        @include('dashboard.room.modals.delete-room')
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $room['title'] }}</td>
                                            <td>{{ $room['category'] }}</td>
                                            <td>{{ $room['roomNumber'] }}</td>
                                            <td>@if($room['roomClean'] == 1) Tidy @else Untidy @endif</td>
                                            <td>@if($room['roomBooked'] == 1) Booked @else Available @endif</td>
                                            <td>@if($room['roomShown'] == 1) Published @else No @endif</td>
                                            <td class="d-flex">
                                                <a href="{{ route('b-room',$room['slug']) }}" class="btn btn-primary mr-1">
                                                    <i class="fas fa-eye"></i> view
                                                </a>
                                                @can(\App\Services\Permissions::CAN_UPDATE_ROOM)
                                                    <a href="{{ route('b-edit-room',$room['slug']) }}" class="btn btn-warning mr-1">
                                                        <i class="fas fa-edit"></i> edit
                                                    </a>
                                                @endcan
                                                @can(\App\Services\Permissions::CAN_DELETE_ROOM)
                                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#removeRoom_{{ $room['id'] }}">
                                                        <i class="fas fa-trash-alt"></i> delete
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                           {{ $items->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

