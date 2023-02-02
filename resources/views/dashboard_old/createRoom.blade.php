@extends('layouts.backEnd')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-primary">
     <i class="fa fa-angle-left"></i>   Go Back
    </a>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title text-white-50 rounded p-3 font-weight-bold" style="background-color: #3A3F51">Add Room</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="{{ route('b-room.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room Number</label>
                            <input
                                value="{{ old('roomNumber') }}"
                                name="roomNumber"
                                class="form-control @error('roomNumber') is-invalid @enderror"
                                type="text" placeholder="room number"
                            >
                            @error('roomNumber')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room type</label>
                            <select class="select" name="category">
                                <option disabled>Select</option>
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="quad">Quad</option>
                                <option value="king">King</option>
                                <option value="suite">Suite</option>
                                <option value="villa">Villa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room Title</label>
                            <input
                                value="{{ old('title') }}"
                                name="title"
                                class="form-control @error('title')is-invalid @enderror"
                                type="text"
                                placeholder="Room Title"
                            >
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input
                                value="{{ old('price') }}"
                                name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                type="text"
                                placeholder="Room price"
                            >
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
{{--                <div class="custom-file mb-3">--}}
{{--                    <input type="file" class="custom-file-input" name="filename">--}}
{{--                    <label class="custom-file-label">Choose file (Photo)</label>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label>Description</label>
                    <textarea
                        name="description"
                        cols="30"
                        rows="4"
                        class="form-control"
                        placeholder="Description"
                        required
                    >{{ old('description') }}</textarea>


                </div>
                <div class="form-group">
                    <label>Extra Information</label>
                    <textarea
                        placeholder="extra information"
                        name="extraInfo"
                        cols="30"
                        rows="4"
                        class="form-control"
                        required>{{ old('extraInfo') }}</textarea>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    <button type="button" class="btn btn-danger submit-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('title','Create a new room')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-datetimepicker.min.css">
@endpush

@push('scripts')
    <script src="/assets/js/select2.min.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/plugins/fileupload/fileupload.min.js"></script>
@endpush


