<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title',$seo->meta_title)</title>
    <!-- Favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('public/uploads/logo/'.$logos->favicon)}}" />

    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/backend.css?v=1.0.1">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/datepiker.css">

    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/datatables.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/select2.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@icon/dripicons/dripicons.css">

    <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/core/main.css" />
    <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/daygrid/main.css" />
    <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/timegrid/main.css" />
    <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/list/main.css" />
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/mapbox/mapbox-gl.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/izitost.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/fullcalender.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/jquery.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <style>
        .form-control {
            border: 1px solid #443f3f;
        }
      
    </style>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <a href="{{route('admin.hotel')}}" class="header-logo">
                    <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" class="img-fluid rounded-normal light-logo" alt="logo">
                    <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" class="img-fluid rounded-normal darkmode-logo" alt="logo">
                </a>
                <div class="iq-menu-bt-sidebar">
                    <i class="las la-bars wrapper-menu"></i>
                </div>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="{{ request()->routeIs('admin.hotel*') ? 'active' : '' }}">
                            <a href="{{route('admin.hotel')}}">
                                <i class="las la-home"></i><span>Dashboards</span>
                            </a>

                        </li>
                        <li class=" ">
                            <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-bed"></i><span>Room</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="user" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->routeIs('admin.room.index*') ? 'active' : '' }}">
                                    <a href="{{route('admin.room.index')}}">
                                        <i class="las la-list-alt"></i><span>All Room</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.room.create*') ? 'active' : '' }}">
                                    <a href="{{route('admin.room.create')}}">
                                        <i class="las la-list-alt"></i><span>Add Room</span>
                                    </a>
                                </li>
                                <!-- <li class="">
                                      <a href="">
                                          <i class="las la-list-alt"></i><span>Room Attributes</span>
                                      </a>
                                  </li> -->
                                <li class="{{ request()->routeIs('admin.rooomtype.create*') ? 'active' : '' }}">
                                    <a href="{{route('admin.rooomtype.create')}}">
                                        <i class="las la-list-alt"></i><span>Add Room Type</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class=" ">
                            <a href="#advance_booking" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-money-bill-alt"></i><span>Advance Booking</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="advance_booking" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->routeIs('admin.advance.booking') ? 'active' : '' }}">
                                    <a href="{{route('admin.advance.booking')}}">
                                        <i class="las la-list-alt"></i><span>Advance Booking</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.advance.booking.report') ? 'active' : '' }}">
                                    <a href="{{route('admin.advance.booking.report')}}">
                                        <i class="las la-list-alt"></i><span>Advance Reports</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.advance.booking.calender') ? 'active' : '' }}">
                                    <a href="{{route('admin.advance.booking.calender')}}">
                                        <i class="las la-list-alt"></i><span>Booking Calender</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.advance.booking.calender.daybyday') ? 'active' : '' }}">
                                    <a href="{{route('admin.advance.booking.calender.daybyday')}}">
                                        <i class="las la-list-alt"></i><span>Day By Day Calender</span>
                                    </a>
                                </li>


                            </ul>
                        </li>


                        <li class="">
                            <a href="#occupancy" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="fas fa-fw fa-calendar-check"></i><span>Occupancy Report</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="occupancy" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.occupancey.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.occupancey.report')}}">
                                        <i class="las la-list-alt"></i><span>In-House Guest</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.expected.checkout.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.expected.checkout.report')}}">
                                        <i class="las la-list-alt"></i><span>Expected Checkout Report</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.expected.occupancy.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.expected.occupancy.report')}}">
                                        <i class="las la-list-alt"></i><span>Occupancy Report</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.expected.occupancy.report.icon*') ? 'active' : '' }}">
                                    <a href="{{route('admin.expected.occupancy.report.icon')}}">
                                        <i class="las la-list-alt"></i><span>Occ. Report(Icon)</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="">
                            <a href="#arrival_departure" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="fas fa-fw fa-plane"></i><span>Arrival & Departure Reports</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="arrival_departure" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.arrival.departure.checkin.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.arrival.departure.checkin.report')}}">
                                        <i class="las la-list-alt"></i><span>CheckIn Reports</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.arrival.departure.checkout.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.arrival.departure.checkout.report')}}">
                                        <i class="las la-list-alt"></i><span>CheckOut Reports</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.arrival.departure.guest.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.arrival.departure.guest.report')}}">
                                        <i class="las la-list-alt"></i><span>Guest Arrival Report</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.arrival.departure.pending.invoice.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.arrival.departure.pending.invoice.report')}}">
                                        <i class="las la-list-alt"></i><span>Pending Checkout for Invoice</span>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="">
                            <a href="#housekeepingreport" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-broom"></i><span>HouseKeeping Report</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="housekeepingreport" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.houseKeeping.extra.service.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.houseKeeping.extra.service.report')}}">
                                        <i class="las la-list-alt"></i><span>Extra Service Report</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.houseKeeping.day.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.houseKeeping.day.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Day Wise Housekeeping</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.houseKeeping.room.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.houseKeeping.room.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Room Wise Housekeeping</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.houseKeeping.employee.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.houseKeeping.employee.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Employee Wise Housekeeping</span>
                                    </a>
                                </li>






                            </ul>
                        </li>


                        <li class="">
                            <a href="#reservation" class="collapsed" data-toggle="collapse" aria-expanded="false">
                           <i class="fas fa-chart-pie"></i><span>Reservation Analysis</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="reservation" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->routeIs('admin.reservation.analysis.room.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.reservation.analysis.room.report')}}">
                                        <i class="las la-list-alt"></i><span>Room Wise Analysis</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.reservation.analysis.room.type.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.reservation.analysis.room.type.report')}}">
                                        <i class="las la-list-alt"></i><span>Room Type Analysis</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="">
                            <a href="#collectionreport" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-box"></i><span>Collection Report</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="collectionreport" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->routeIs('admin.daily.collection.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.daily.collection.report')}}">
                                        <i class="las la-list-alt"></i><span>Daily Collection</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.guest.payment.history*') ? 'active' : '' }}">
                                    <a href="{{route('admin.guest.payment.history')}}">
                                        <i class="las la-list-alt"></i><span>Guest Payment History</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.invoice.summary.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.invoice.summary.report')}}">
                                        <i class="las la-list-alt"></i><span>Invoice Summary</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.post.to.room.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.post.to.room.report')}}">
                                        <i class="las la-list-alt"></i><span>Post To Room</span>
                                    </a>
                                </li>

                              

                            </ul>
                        </li>
                        <li class="">
                            <a href="#setting" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="far fa-user"></i><span>Setting</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="setting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ request()->routeIs('admin.itementry.create*') ? 'active' : '' }}">
                                    <a href="{{route('admin.tax.index')}}">
                                        <i class="las la-list-alt"></i><span>Tax Setting</span>
                                    </a>
                                </li>



                            </ul>
                        </li>

                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="index.html" class="header-logo">
                            <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" class="img-fluid rounded-normal light-logo" alt="logo">
                            <img src="{{asset('public/backend')}}/assets/images/logo-white.png" class="img-fluid rounded-normal darkmode-logo" alt="logo">

                        </a>
                    </div>
                    <div class="iq-search-bar device-search">
                        <form action="#" class="searchbox">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                            <input type="text" class="text search-input" placeholder="Search here...">
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="change-mode">
                            <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                                <div class="custom-switch-inner">
                                    <p class="mb-0"> </p>
                                    <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                    <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                        <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                        <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-search-line"></i>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                                <a href="#" class="search-link"><i class="las la-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-mail-line  bg-orange p-2 rounded-small"></i>
                                        <span class="bg-primary"></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <h5 class="mb-0">All Messages</h5>
                                                </div>
                                                <div class="p-3">
                                                    @php
                                                    $allmessage=App\Models\ContactMessage::where('is_seen',0)->orderBy('id','DESC')->get();
                                                    @endphp
                                                    @foreach($allmessage as $data)
                                                    <a href="{{route('admin.email')}}" class="iq-sub-card">
                                                        <div class="media align-items-center">
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">{!! Str::limit($data->message,25) !!}</h6>
                                                                <small class="float-left font-size-12">{{$data->created_at}}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @endforeach
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="{{route('admin.email')}}" role="button">
                                                    <div class="dd-icon"><i class="las la-arrow-right mr-0"></i></div>
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item iq-full-screen"><a href="#" class="" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                                <li class="caption-content">
                                    <a href="#" class="iq-user-toggle">
                                        <img src="{{asset('public/uploads/admin/'.Auth::user()->profile_photo_path)}}" class="img-fluid rounded" alt="user">
                                    </a>
                                    <div class="iq-user-dropdown">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                                <div class="header-title">
                                                    <h4 class="card-title mb-0">Profile</h4>
                                                </div>
                                                <div class="close-data text-right badge badge-primary cursor-pointer"><i class="ri-close-fill"></i></div>
                                            </div>
                                            <div class="data-scrollbar" data-scroll="2">
                                                <div class="card-body">
                                                    <div class="profile-header">
                                                        <div class="cover-container ">
                                                            <div class="media align-items-center mb-4">
                                                                <img src="{{asset('public/uploads/admin/'.Auth::user()->profile_photo_path)}}" alt="profile-bg" class="rounded img-fluid avatar-80">
                                                                <div class="media-body profile-detail ml-3">
                                                                    <h3>{{Auth::user()->name}}</h3>
                                                                    <div class="d-flex flex-wrap">
                                                                        <p class="mb-1">Web designer</p>
                                                                        <a href="{{ route('admin.logout') }}" class="ml-3">Sign Out</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6  col-6 pr-0">
                                                                <div class="profile-details text-center">
                                                                    <a href="{{url('admin/user/view/'.Auth::user()->id)}}" class="iq-sub-card bg-primary-light rounded-small p-2">
                                                                        <div class="rounded iq-card-icon-small">
                                                                            <i class="ri-file-user-line"></i>
                                                                        </div>
                                                                        <h6 class="mb-0">My Profile</h6>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  col-md-6 col-6">
                                                                <div class="profile-details text-center">
                                                                    <a href="{{url('admin/user/edit/'.Auth::user()->id)}}" class="iq-sub-card bg-danger-light rounded-small p-2">
                                                                        <div class="rounded iq-card-icon-small">
                                                                            <i class="ri-profile-line"></i>
                                                                        </div>
                                                                        <h6 class="mb-0 ">Edit Profile</h6>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6  col-6 pr-0">
                                                                <div class="profile-details text-center">
                                                                    <a href="{{route('password.chamge')}}" class="iq-sub-card bg-success-light rounded-small p-2">
                                                                        <div class="rounded iq-card-icon-small">
                                                                            <i class="ri-account-box-line"></i>
                                                                        </div>
                                                                        <h6 class="mb-0 ">Pass Change</h6>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="personal-details">
                                                            <h5 class="card-title mb-3 mt-3">Personal Details</h5>

                                                            <div class="row align-items-center mb-2">
                                                                <div class="col-sm-6">
                                                                    <h6>Address:</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="mb-0">{{Auth::user()->address}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-2">
                                                                <div class="col-sm-6">
                                                                    <h6>Phone:</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="mb-0">{{Auth::user()->phone}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-2">
                                                                <div class="col-sm-6">
                                                                    <h6>Email:</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="mb-0">{{Auth::user()->email}}</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="p-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- yieldd -->

        @yield('content')



        <!-- yield -->
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="">SoftWare Version: 1.1</a></li>

                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">DurbarIt</a> All Rights Reserved.
                </div>
            </div>

        </div>
    </footer>



    @include('../layouts/inc/footer_menu')









    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/backend-bundle.min.js"></script>

    <!-- Flextree Javascript-->
    <script src="{{asset('public/backend')}}/assets/js/flex-tree.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/tree.js"></script>
    <script src="{{asset('public/backend')}}/assets/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/table-treeview.js"></script>

    <!-- Masonary Gallery Javascript -->
    <script src="{{asset('public/backend')}}/assets/js/masonry.pkgd.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/imagesloaded.pkgd.min.js"></script>

    <!-- Mapbox Javascript -->
    <script src="{{asset('public/backend')}}/assets/js/mapbox-gl.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/mapbox.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/datepiker.js"></script>

    <!-- Fullcalender Javascript -->
    <script src="{{asset('public/backend')}}//assets/vendor/fullcalendar/core/main.js"></script>
    <script src="{{asset('public/backend')}}//assets/vendor/fullcalendar/daygrid/main.js"></script>
    <script src="{{asset('public/backend')}}/assets/vendor/fullcalendar/timegrid/main.js"></script>
    <script src="{{asset('public/backend')}}/assets/vendor/fullcalendar/list/main.js"></script>

    <!-- SweetAlert JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/sweetalert.js"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/vector-map-custom.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/customizer.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/chart-custom.js"></script>



    <!-- slider JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/slider.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/timepicker.js"></script>

    <!-- alert -->
    <script src="{{asset('public/backend')}}/assets/js/izitost.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/fullcalender.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/select2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/datatables.js"></script>
    <script src="{{asset('public/backend')}}/assets/jquery.PrintArea.js"></script>

    <script>
        @if(Session::has('messege'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'success':

                iziToast.success({
                    message: '{{ Session::get('messege') }}',
                    'position': 'topCenter'
                });
                brack;
            case 'info':
                iziToast.info({
                    message: '{{ Session::get('messege') }}',
                    'position': 'topRight'
                });
                brack;
            case 'warning':
                iziToast.warning({
                    message: '{{ Session::get('messege')}}',
                    'position': 'topRight'
                });
                break;
            case 'error':
                iziToast.error({
                    message: '{{ Session::get('messege')}}',
                    'position': 'topRight'
                });
                break;
        }
        @endif
    </script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Safe Data!");
                    }
                });
        });
    </script>
    <!-- app JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $('#datepicker').datepicker();
    </script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
        });
    </script>
    <script>
        $('.datepickernew').datepicker({
            format: 'dd-mm-yyyy',
        });
        $('#datepickerdaly').datepicker({
        format: 'dd/mm/yyyy',
    });
    </script>



    <script>
        $("#select_room_no").select2({
            placeholder: '----Select Room No----'
        });
    </script>


    <script>
        $(function() {
            $(".savepritbtn").on('click', function() {

                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableAreasaveprint").printArea(options);
            });
        });
    </script>



    <script src="{{asset('public/backend')}}/assets/js/app.js"></script>
</body>

</html>