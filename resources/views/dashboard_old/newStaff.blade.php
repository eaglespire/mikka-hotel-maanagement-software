@extends('layouts.backEnd')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Add Staff</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @include('flash.success', ['successFlash' => 'success'])
            @include('flash.error', ['errorFlash' => 'error'])
            <form method="post" action="{{ route('b-store-staff') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" type="text">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" type="text">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date of Birth <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input name="dob" class="form-control datetimepicker @error('dob') is-invalid @enderror" type="text">
                                @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Joining Date <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input name="join_date" class="form-control datetimepicker @error('join_date') is-invalid @enderror" type="text">
                                @error('join_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone </label>
                            <input name="phone" class="form-control @error('phone') is-invalid @enderror" type="text">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Role</label>
                            @if(!empty($roles))
                                <select class="select" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role['name'] }}">{{ $role['name'] }}</option>
                                    @endforeach
                                </select>
                            @endif


                        </div>
                    </div>
                    <div class="col-sm-12">
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
                <div class="m-t-20 text-center">
                    <button @if(!isset($roles)) disabled @endif type="submit" class="btn btn-primary submit-btn">Create Staff</button>
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
