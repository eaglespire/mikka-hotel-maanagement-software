@extends('layouts.backEnd')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-3">
            <img
                class="rounded-circle"
                width="200"
                height="200"
                src="@if(auth()->user()->photo === null) {{ asset('storage/users/user.jpg') }} @else
                                 {{ asset('storage/users/'.auth()->user()->photo) }} @endif"
                alt="profile image">
        </div>
        <div class="col-lg-9">
            <div class="card card-body">
                <form action="{{ route('b-update-profile') }}" method="post" class="row">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="form-label">FirstName</label>
                            <input name="firstname" value="{{ auth()->user()->firstname }}"  type="text"
                                   class="form-control @error('firstname') is-invalid @enderror">
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="form-label">LastName</label>
                            <input name="lastname" type="text" value="{{ auth()->user()->lastname }}"
                                   class="form-control @error('lastname') is-invalid @enderror">
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="" class="form-label">Phone Number</label>
                            <input name="phone" type="text" value="{{ auth()->user()->phone }}"
                                   class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-lg-4">
            <div class="m-b-30">
                <div class="card card-body">
                    <h6 class="my-3">Upload New Profile Image</h6>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <form method="post" action="{{ route('b-profile-image-upload') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="dropzone">
                            <div class="fallback">
                                <input name="photo" type="file">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @livewire('dashboard.change-password')
            @livewire('dashboard.change-email')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
@endpush
