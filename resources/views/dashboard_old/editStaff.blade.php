@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Update Profile Information of {{ $staff->fullname }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @include('flash.success', ['successFlash' => 'success'])
            @include('flash.error', ['errorFlash' => 'error'])
            <form method="post" action="{{ route('b-update-staff',$staff->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input value="{{ $staff->firstname }}" name="firstname" class="form-control @error('firstname') is-invalid @enderror"
                                   type="text">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input value="{{ $staff->lastname }}" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                                   type="text">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date of Birth <span class="text-danger">*</span> <span>(Currently selected: {{
                            $staff->dob?->toFormattedDateString() }})</span></label>
                            <div class="cal-icon">
                                <input value="{{ $staff->dob }}" name="dob" class="form-control datetimepicker @error('dob') is-invalid @enderror"
                                       type="text">
                                @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input value="{{ $staff->email }}" name="email" class="form-control @error('email') is-invalid @enderror" type="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input value="{{ $staff->password_text }}" name="password_text"
                                   class="form-control @error('password_text') is-invalid @enderror"
                                   type="text">
                            @error('password_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Joining Date <span class="text-danger">*</span> <span>(Currently selected:
                                    {{$staff->join_date?->toFormattedDateString() }})</span></label>
                            <div class="cal-icon">
                                <input value="{{ $staff->join_date }}" name="join_date" class="form-control datetimepicker @error('join_date')
                                is-invalid @enderror" type="text">
                                @error('join_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone </label>
                            <input value="{{ $staff->phone }}" name="phone" class="form-control @error('phone') is-invalid @enderror" type="text">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @livewire('dashboard.assign-or-revoke-role',['user' => $staff])
                    </div>
                    <div class="col-sm-12">
                        <p>Current Image: <img width="100" height="64" src="{{ asset('storage/users/'.$staff->photo) }}" alt="image"></p>
                        <div class="custom-file-container" data-upload-id="myFirstImage">
                            <label>Upload (Staff Profile Image)
                                <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                   title="Clear Image">x</a>
                            </label>
                            <label class="custom-file-container__custom-file">
                                <input name="photo" type="file"
                                       class="custom-file-container__custom-file__custom-file-input
                                       @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="MAX_FILE_SIZE" value="1024"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="display-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="employee_active" value="1" @if($staff->status === 1)
                            checked @endif>
                        <label class="form-check-label" for="employee_active">
                            Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="employee_inactive" value="0" @if($staff->status === 0) checked
                            @endif>
                        <label class="form-check-label" for="employee_inactive">
                            Inactive
                        </label>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

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
