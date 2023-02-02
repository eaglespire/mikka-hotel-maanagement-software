@extends('layouts.backEnd')



@section('content')
    @livewire('modules.calendar')
    <div class="row">
        <div class="col-md-12">
            <div class="flex-wrap d-flex justify-content-between align-items-center">
                <div>
                    <h3>Hi, {{ auth()->user()->fullname }}!</h3>
                </div>
                <div>
                    <button data-toggle="modal" data-target="#new-event" type="button" class="btn btn-primary ms-2 text-right float-end mb-lg-0
                    mb-3">
                        <span>Add Event</span>
                        <svg width="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M16.9927 15.9531H11.2984C10.7429 15.9531 10.291 16.4121 10.291 16.9765C10.291 17.5419 10.7429 17.9999 11.2984 17.9999H16.9927C17.5483 17.9999 18.0001 17.5419 18.0001 16.9765C18.0001 16.4121 17.5483 15.9531 16.9927 15.9531Z" fill="white"/>
                            <path d="M7.30902 3.90361L12.7049 8.2637C12.835 8.36797 12.8573 8.55932 12.7557 8.69261L6.35874 17.028C5.95662 17.5429 5.36402 17.8342 4.72908 17.8449L1.23696 17.8879C1.05071 17.8901 0.887748 17.7611 0.845419 17.5762L0.0517547 14.1255C-0.0858138 13.4913 0.0517547 12.8356 0.453878 12.3303L6.88256 3.95521C6.98627 3.82083 7.1778 3.79719 7.30902 3.90361Z" fill="white"/>
                            <path opacity="0.4" d="M15.1203 5.66544L14.0801 6.96401C13.9753 7.09623 13.7869 7.11773 13.6568 7.01238C12.3922 5.98901 9.15405 3.36285 8.25563 2.63509C8.12441 2.52759 8.10642 2.33625 8.21224 2.20295L9.21543 0.957057C10.1255 -0.214663 11.7128 -0.322161 12.9933 0.699064L14.4642 1.87078C15.0674 2.34377 15.4695 2.96726 15.6071 3.62299C15.7658 4.3443 15.5965 5.0527 15.1203 5.66544Z" fill="white"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @livewire('dashboard.event-list')
    @livewire('dashboard.calendar')
    <div class="modal fade" id="new-event" data-keyboard="true" tabindex="-1" aria-labelledby="new-event-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-event-label">Add an event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('b-event.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="email">Title:</label>
                            <input
                                value="{{ old('title') }}"
                                placeholder="title"
                                required
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                name="title">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="pwd">Start Date:</label>
                            <input required value="2023-01-11" type="date" class="form-control @error('start') is-invalid @enderror" name="start">
                            @error('start')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="pwd">End Date:</label>
                            <input required value="2023-01-11" type="date" class="form-control @error('end') is-invalid @enderror" name="end">
                            @error('end')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




