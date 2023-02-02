<div wire:key="event-list-component-{{ \Illuminate\Support\Str::random() }}">
    @if($events->count() !== 0)
        <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Event List</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive border rounded">
                    <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                        <tr class="light">
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th style="min-width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->start_time }}</td>
                                <td>{{ $event->finish_time }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a wire:click.prevent="launchEditModal({{ $event->id }})" class="btn btn-sm btn-icon btn-warning
                                        rounded"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="" data-original-title="Edit" href="#">
                                    <span class="btn-inner">
                                       <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                    </span>
                                        </a>
                                        <a  wire:click.prevent="$emit('triggerDelete', {{ $event->id }})" class="btn btn-sm btn-icon btn-danger rounded"
                                            data-toggle="tooltip"
                                            data-placement="top" title=""
                                            data-original-title="Delete" href="#">
                                    <span class="btn-inner">
                                       <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                          <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                    </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $events->links() }}
            </div>
        </div>
    </div>
    @else
        <p class="bg-primary p-2">There are currently no scheduled events for you</p>
    @endif

    <!-- Edit Modal -->
        <div id="editModal"
             class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             style="display: none;"
              aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Center modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateEvent">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email">Title:</label>
                                <input
                                    wire:model.defer="eventTitle"
                                    placeholder="title"
                                    required
                                    type="text"
                                    class="form-control @error('eventTitle') is-invalid @enderror"
                                    >
                                @error('eventTitle')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">Start Date: {{ $eventStart }}</label>
                                <input required wire:model.defer="eventStart" type="date" class="form-control \
                                @error('eventStart') is-invalid @enderror ">

                                @error('eventStart')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">End Date: {{ $eventEnd }}</label>
                                <input required wire:model.defer="eventEnd" type="date" class="form-control @error('end') is-invalid @enderror"
                                       name="end">
                                @error('eventEnd')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <!-- Edit Modal -->
</div>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', eventId => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Event will be deleted!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    //if user clicks on delete
                    if (result.value) {
                        // calling deleteEvent method to delete
                        @this.call('deleteEvent',eventId)
                        // success response
                        Swal.fire({title: 'Event deleted successfully!', icon: 'success'});
                    } else {
                        Swal.fire({
                            title: 'Operation Cancelled!',
                            icon: 'success'
                        });
                    }
                });
            });

            @this.on('LaunchUpdateModal', event=>{
                $('#editModal').modal('show')
            })
            @this.on('EventUpdated', event=>{
                Swal.fire({
                    title: 'Success',
                    text: 'Event updated!',
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    concelButtonText: 'Close!'
                })
                $('#editModal').modal('hide')
                $('body').removeClass('modal-open')
                $('.modal-backdrop').remove()
                window.location.reload()
            })
        })
    </script>
@endpush
