<div class="row" wire:key="calendar-module-{{ Str::random() }}">
    <div class="col-md-12">
        @can(\App\Services\Permissions::CAN_ACCESS_EVENTS)
        <x-back-button header-title="Events">
            <a wire:click.prevent="OpenModal" href="" class="btn btn-success">
                <i class="ion ion-md-create"></i> New
            </a>
        </x-back-button>
        @endcan
    </div>

    <div class="col-md-12 my-3">
        @if($events->count() !== 0)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive border rounded">
                        <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                            <thead>
                            <tr class="light">
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                @can(\App\Services\Permissions::CAN_ACCESS_SETTINGS)
                                    <th style="min-width: 100px">Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->start_time }}</td>
                                    <td>{{ $event->finish_time }}</td>
                                    @can(\App\Services\Permissions::CAN_ACCESS_SETTINGS)
                                        <td>
                                            <div class="d-flex align-items-center list-user-action">
                                                <button class="btn btn-secondary mr-1" wire:click.prevent="OpenModal(1,'{{ $event['id'] }}')">
                                                    <i class="ti-marker-alt"></i> edit
                                                </button>
                                                <button wire:click.prevent="$emit('delete-event',{{ $event->id }})" class="btn btn-danger">
                                                    <i class="ti-trash"></i> trash
                                                </button>
                                            </div>
                                        </td>
                                    @endcan
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
    </div>

    <div class="col-md-12 my-3" >
        <div id="calendar"></div>
    </div>

    <x-custom :modal-header="$modalHeader">
        <form>
            <div class="form-group">
                <label class="form-label" for="email">Title:</label>
                <input
                    wire:model.defer="title"
                    placeholder="title"
                    required
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                >
                @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="pwd">Start Date: {{ $start }}</label>
                <input required wire:model.defer="start" type="date" class="form-control @error('start') is-invalid @enderror">
                @error('start')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="pwd">End Date: {{ $end }}</label>
                <input required wire:model.defer="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end">
                @error('end')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Comment</label>
                <textarea wire:model.defer="comment" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="my-2 alert alert-info" wire:loading.block wire:target='SaveNewEvent,UpdateEvent'>
                processing...
            </div>
              @if($mode === 0)
                <button wire:click.prevent="SaveNewEvent" type="submit" class="btn btn-primary">{{ $btnText }}</button>
              @else
                <button wire:click.prevent="UpdateEvent" type="submit" class="btn btn-primary">{{ $btnText }}</button>
              @endif
        </form>
    </x-custom>

</div>


@push('scripts')
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function () {

            @this.on('success', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Operation successful',
                    toast: true,
                    position:'top-end',
                    timer: 10000
                })
            })
            @this.on('fail', () => {
                Swal.fire({
                    icon: 'Error',
                    title: 'An error occurred',
                    toast: true,
                    position:'top-end',
                    timer: 10000
                })
            })

            @this.on('delete-event', id => {
                Swal.fire({
                    icon: 'question',
                    title: 'Proceed to delete?',
                    confirmButtonText: 'Yes, delete',
                    showCancelButton:true,
                    confirmButtonColor:'#EC4561'
                }).then(response => {
                    if(response.isConfirmed){
                        @this.call('DeleteEvent',id)
                    }  else{
                        Swal.fire({
                            text:'Operation cancelled'
                        })
                    }
                })

            })
        })
    </script>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($eventList),
            });
            calendar.render();

            @this.on('refreshCalendar', () => {
                calendar.refetchEvents();
            })
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush

@push('styles')
    <style>
        .fc-day-today {
            background: #252735 !important;
            border: none !important;
        }
    </style>
@endpush
