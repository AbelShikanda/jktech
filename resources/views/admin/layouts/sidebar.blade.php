<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('admin/assets/images/logo.png') }}" alt="logo" class="w-50">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('dashboard.index') }}"><span
                                class="ml-1 item-text">Home</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('schedules') }}"><span
                                class="ml-1 item-text">schedule</span></a>
                    </li> --}}
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Booking Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Booking</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Consultation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Class</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-credit-card fe-16"></i>
                    <span class="ml-3 item-text">Service Components</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('services.index') }}"><span
                                class="ml-1 item-text">Services</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('service_categories.index') }}"><span
                                class="ml-1 item-text">Categories</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('types.index') }}"><span 
                            class="ml-1 item-text">Types</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Images</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Prices</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>User Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-pie-chart fe-16"></i>
                    <span class="ml-3 item-text">User Components</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Users</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Contacts</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Admins</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#chart" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-pie-chart fe-16"></i>
                    <span class="ml-3 item-text">User Management</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="chart">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Roles</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Permissions</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Blog Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">

            <li class="nav-item dropdown">
                <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Blog Components</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Articles</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Categories</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Images</span></a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Comments</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- <p class="text-muted nav-heading mt-4 mb-1">
            <span>Promo Codes Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">

            <li class="nav-item dropdown">
                <a href="#table" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Promotion Codes</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="table">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="#"><span
                                class="ml-1 item-text">Promo Codes</span></a>
                    </li>
                </ul>
            </li>
        </ul> -->
    </nav>
</aside>
