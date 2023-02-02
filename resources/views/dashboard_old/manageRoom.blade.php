@extends('layouts.backEnd')

@section('title','Manage Room')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-primary">
        <i class="fa fa-angle-left"></i>   Go Back
    </a>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Profile</h4>
        </div>
    </div>
    <form>
        <div class="card-box">
            <h3 class="card-title">Basic Informations</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-img-wrap">
                        <img class="inline-block" src="assets/img/user.jpg" alt="user">
                        <div class="fileupload btn">
                            <span class="btn-text">edit</span>
                            <input class="upload" type="file">
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input class="form-control" type="text" value="John">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name </label>
                                    <input class="form-control" type="text" value="Doe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" value="05/06/1985">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gendar</label>
                                    <select class="select form-control">
                                        <option value="male selected">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Contact Informations</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" value="4487 Snowbird Lane">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" value="New York">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" value="United States">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" class="form-control" value="10523">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" value="631-889-3206">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Education Informations</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Institution</label>
                        <input type="text" class="form-control" value="Oxford University">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" value="Computer Science">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Starting Date</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" value="01/06/2002">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Complete Date</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" value="31/05/2006">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" class="form-control" value="BE Computer Science">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Grade</label>
                        <input type="text" class="form-control" value="Grade A">
                    </div>
                </div>
            </div>
            <div class="add-more">
                <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add More Institute</a>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Experience Informations</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" value="Digital Devlopment Inc">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" value="United States">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Job Position</label>
                        <input type="text" class="form-control" value="Web Developer">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Period From</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" value="01/07/2007">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Period To</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" value="08/06/2018">
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-more">
                <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add More Experience</a>
            </div>
        </div>
        <div class="text-center m-t-20">
            <button class="btn btn-primary submit-btn" type="button">Save</button>
        </div>
    </form>
@endsection
