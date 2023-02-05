<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Home</li>
                <li>
                    <a href="/" class="waves-effect" target="_blank">
                        <i class="ti-home"></i> <span> Home Page </span>
                    </a>
                </li>
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('b-dashboard.index') }}" class="waves-effect">
                        <i class="ti-dashboard"></i> <span> Dashboard </span>
                    </a>
                </li>

                @can(\App\Services\Permissions::CAN_READ_ROLES)
                    <li>
                        <a href="{{ route('b-roles') }}" class="waves-effect"><i class="ti-id-badge"></i><span> Roles </span></a>
                    </li>
                @endcan


                <li class="menu-title">Modules</li>

                <li>
                    <a href="{{ route('b-event.index') }}" class="waves-effect"><i class="ti-calendar"></i><span> Events </span></a>
                </li>
                <li>
                    <a href="{{ route('b-faq') }}" class="waves-effect"><i class="ti-calendar"></i><span> FAQ </span></a>
                </li>
                <li>
                    <a href="{{ route('b-pricing') }}" class="waves-effect"><i class="ti-calendar"></i><span> Pricing </span></a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Blog <span
                                class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{ route('b-posts') }}">Posts</a></li>
                        <li><a href="{{ route('b-post-category') }}">Categories</a></li>
                    </ul>
                </li>

                <li class="menu-title">Components</li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Rooms <span
                                class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{ route('b-rooms') }}">All Rooms</a></li>
                        <li><a href="{{ route('b-room-features') }}">All Features</a></li>
                    </ul>
                </li>
                @can(\App\Services\Permissions::CAN_READ_BOOKINGS)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Booking <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                        <ul class="submenu">
                            <li><a href="a.html">Add Booking</a></li>
                            <li><a href="b.html">All Bookings</a></li>
                        </ul>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_READ_CUSTOMERS)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Customers <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                        <ul class="submenu">
                            <li><a href="s.html">Add Customer</a></li>
                            <li><a href="l.html">All Customers</a></li>
                        </ul>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_READ_EMPLOYEES)
                    <li>
                        <a href="{{ route('b-employee') }}" class="waves-effect"><i class="ti-calendar"></i><span> Employees </span></a>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_MANAGE_SETTINGS)
                    <li class="menu-title">Pages</li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pie-chart"></i><span> Manage Pages <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{ route('b-about-page') }}">About</a></li>
                            <li><a href="r.html">Contact</a></li>
                            <li><a href="r.html">Rooms</a></li>
                        </ul>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_READ_EXPENSES)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pie-chart"></i><span> Accounts <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="hh.html">All Accounts</a></li>
                            <li><a href="r.html">Add Account</a></li>
                        </ul>
                    </li>
                @endcan
                @can(\App\Services\Permissions::CAN_READ_INVOICES)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pie-chart"></i><span> Payroll <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="hh.html">All Payrolls</a></li>
                            <li><a href="r.html">Add Payroll</a></li>
                        </ul>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_READ_ASSETS)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pie-chart"></i><span> Assets <span
                                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="hh.html">All Assets</a></li>
                            <li><a href="r.html">Add Asset</a></li>
                        </ul>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_READ_EXPENSE_REPORT)
                    <li>
                        <a href="" class="waves-effect"><i class="ti-id-badge"></i><span> Reports </span></a>
                    </li>
                @endcan

                @can(\App\Services\Permissions::CAN_MANAGE_SETTINGS)
                    <li>
                        <a href="{{ route('b-settings.index') }}" class="waves-effect"><i class="ti-id-badge"></i><span> Settings </span></a>
                    </li>
                @endcan
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
