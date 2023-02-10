@extends('layouts.backEnd')
@section('content')
    <div class="row">
        <div class="col">
            <x-back-button header-title="All Rooms">
                @can(\App\Services\Permissions::CAN_CREATE_ROOMS)
                    @if($categoriesCount == 0)
                        <a  href="{{ route('b-room-categories') }}" class="btn btn-success">
                            <i class="ion ion-md-create"></i> Please add a Category
                        </a>
                    @else
                        <a  href="{{ route('b-add-room') }}" class="btn btn-success">
                            <i class="ion ion-md-create"></i> New Room
                        </a>
                    @endif
                @endcan
            </x-back-button>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Rm No</th>
                                <th>Room Clean</th>
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
                                            <td>{{  $room->pricing->title }}</td>
                                            <td>{{ $room['roomNumber'] }}</td>
                                            <td>@if($room['roomClean'] == 1) Yes @else No @endif</td>
                                            <td>@if($room['roomBooked'] == 1) No @else Yes @endif</td>
                                            <td>@if($room['roomShown'] == 1) Yes @else No @endif</td>
                                            <td class="d-flex">
                                                @can(\App\Services\Permissions::CAN_UPDATE_ROOMS)
                                                    <a href="{{ route('b-edit-room',$room['slug']) }}" class="btn btn-warning mr-1">
                                                        <i class="fas fa-edit"></i> edit
                                                    </a>
                                                @endcan
                                                @can(\App\Services\Permissions::CAN_DELETE_ROOMS)
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

