<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                <tr>
                    <th style="width:10%;">S/N</th>
                    <th style="width:10%;">Room number</th>
                    <th style="width:10%;">Img</th>
                    <th>Room title</th>
                    <th>Room type</th>
                    <th style="width:10%;">Price ($)</th>
                    <th style="width:10%;">Booked</th>
                    <th style="width:10%;">Clean</th>
                    <th style="width:10%;">Published</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(sizeof($rooms) !== 0)
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->roomNumber }}</td>
                            <td><img width="28" height="28" src="/assets/img/user.jpg" class="rounded-circle m-r-5" alt=""></td>
                            <td>{{ $room->title }}</td>
                            <td>{{ $room->category }}</td>
                            <td>{{ number_format($room->price,2) }}</td>
                            <td>{{ format_boolean($room->roomBooked) }}</td>
                            <td>{{ format_boolean($room->roomClean) }}</td>
                            <td>{{ format_boolean($room->roomShown) }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('b-room.manage-room',$room->slug) }}"><i class="fas fa-pencil-alt
                                        m-r-5"></i>
                                            Manage</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_room"><i
                                                class="fas fa-trash-alt m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                {{ $rooms->links() }}
            </table>
        </div>
    </div>
</div>
