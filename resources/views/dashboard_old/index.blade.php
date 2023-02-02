@extends('layouts.backEnd')
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="row no-gutters">
                    <div class="col-5">
                        <div class="circle1"></div>
                    </div>
                    <div class="col-7">
                        <div class="dash-widget-info text-right">
                            <h3>75</h3>
                            <span class="widget-title1">Total Booking </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="row no-gutters">
                    <div class="col-5">
                        <div class="circle2"></div>
                    </div>
                    <div class="col-7">
                        <div class="dash-widget-info text-right">
                            <h3>25</h3>
                            <span class="widget-title2">Availble Rooms </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="row no-gutters">
                    <div class="col-5">
                        <div class="circle3"></div>
                    </div>
                    <div class="col-7">
                        <div class="dash-widget-info text-right">
                            <h3>20</h3>
                            <span class="widget-title3">Inquiry </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <div class="row no-gutters">
                    <div class="col-5">
                        <div class="circle4"></div>
                    </div>
                    <div class="col-7">
                        <div class="dash-widget-info text-right">
                            <h3>$ 6000</h3>
                            <span class="widget-title4">Collections </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Income and Expenses</h4>
                </div>
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Visitors</h4>
                </div>
                <div id="visit-area"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Booking</h4> <a href="all-booking.html" class="btn btn-primary float-right">View
                        all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Name</th>
                                <th>Room type</th>
                                <th>Number</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>BKG-0001</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Denise</td>
                                <td>Single</td>
                                <td>987654321</td>
                                <td><span class="custom-badge status-red">Inactive</span></td>
                            </tr>
                            <tr>
                                <td>BKG-0002</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> John</td>
                                <td>Double</td>
                                <td>987654321</td>
                                <td><span class="custom-badge status-green">active</span></td>
                            </tr>
                            <tr>
                                <td>BKG-0003</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Denise</td>
                                <td>Single</td>
                                <td>987654321</td>
                                <td><span class="custom-badge status-green">active</span></td>
                            </tr>
                            <tr>
                                <td>BKG-0004</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> John</td>
                                <td>Double</td>
                                <td>987654321</td>
                                <td><span class="custom-badge status-green">active</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card member-panel">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Pricing </h4> <a href="pricing.html" class="btn btn-primary float-right">View
                        all</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th>Room Type</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-success text-uppercase">Single</td>
                                <td>$ 15</td>
                                <td><a href="pricing.html">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-primary text-uppercase">Double</td>
                                <td>$ 25</td>
                                <td><a href="pricing.html">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-warning text-uppercase">Quad</td>
                                <td>$ 35</td>
                                <td><a href="pricing.html">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-success text-uppercase">Family</td>
                                <td>$ 45</td>
                                <td><a href="pricing.html">View</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Rooms </h4> <a href="all-rooms.html" class="btn btn-primary float-right">View
                        all</a>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th>Room number</th>
                                <th>Img</th>
                                <th>Room type</th>
                                <th>AC/Non-AC</th>
                                <th>Food</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>201</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""></td>
                                <td>Single</td>
                                <td>AC</td>
                                <td>Free Breakfast & Dinner</td>
                            </tr>
                            <tr>
                                <td>202</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""></td>
                                <td>Double</td>
                                <td>Non-AC</td>
                                <td>Free Breakfast</td>
                            </tr>
                            <tr>
                                <td>203</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""></td>
                                <td>Single</td>
                                <td>Non-AC</td>
                                <td>Free Lunch</td>
                            </tr>
                            <tr>
                                <td>204</td>
                                <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""></td>
                                <td>Quad</td>
                                <td>AC</td>
                                <td>Free Breakfast</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Leaves </h4> <a href="leaves.html" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Days</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <h2><a href="#">Albina <span>staff</span></a></h2>
                                </td>
                                <td>Casual Leave</td>
                                <td>2 days</td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><a href="#">Albina Simonis <span>Manager</span></a></h2>
                                </td>
                                <td>Sick Leave</td>
                                <td>2 days</td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><a href="#">Albina Simonis <span>staff</span></a></h2>
                                </td>
                                <td>Casual Leave</td>
                                <td>2 days</td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><a href="#">Albina Simonis <span>staff</span></a></h2>
                                </td>
                                <td>Casual Leave</td>
                                <td>2 days</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
