<div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <a href="{{route('admin.housekipping.home')}}" class="header-logo">
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
                        <li class="{{ request()->routeIs('admin.housekipping.home*') ? 'active' : '' }}">
                            <a href="{{route('admin.housekipping.home')}}">
                                <i class="las la-home"></i><span>Dashboards</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#guest_entry" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-hiking"></i><span>Guest Entry</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="guest_entry" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekipping.person.entry*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.person.entry')}}">
                                        <i class="las la-list-alt"></i><span>Person Entry</span>
                                    </a>
                                </li>

                                
                                <li class="{{ request()->routeIs('admin.housekipping.person.entry.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.person.entry.report')}}">
                                        <i class="las la-list-alt"></i><span>Person Entry Report</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekipping.person.entry.cross.check*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.person.entry.cross.check')}}">
                                        <i class="las la-list-alt"></i><span>Cross Check</span>
                                    </a>
                                </li>




                            </ul>
                        </li>

                        <li class="">
                            <a href="#advancebooking" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="far fa-address-book"></i><span>Advance Booking</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="advancebooking" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekeeping.advance.booking.report.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.advance.booking.report.list')}}">
                                        <i class="las la-list-alt"></i><span>Booking Report</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekeeping.advance.booking.calender*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.advance.booking.calender')}}">
                                        <i class="las la-list-alt"></i><span>Booking Calender</span>
                                    </a>
                                </li>


                                <li class="{{ request()->routeIs('admin.housekeeping.advance.booking.calender.daybyday*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.advance.booking.calender.daybyday')}}">
                                        <i class="las la-list-alt"></i><span>Day By Day Calender</span>
                                    </a>
                                </li>

                               

                            
                            </ul>
                        </li>

                        <li class="">
                            <a href="#occupancy" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fab fa-adn"></i><span>Occupancy Report</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="occupancy" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekeeping.occupancey.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.occupancey.report')}}">
                                        <i class="las la-list-alt"></i><span>In-House Guest</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekeeping.expected.checkout.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.expected.checkout.report')}}">
                                        <i class="las la-list-alt"></i><span>Expected Checkout Report</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekeeping.expected.occupancy.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.expected.occupancy.report')}}">
                                        <i class="las la-list-alt"></i><span>Occupancy Report</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekeeping.expected.occupancy.report.icon*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.expected.occupancy.report.icon')}}">
                                        <i class="las la-list-alt"></i><span>Occ. Report(Icon)</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        
                        <li class="">
                            <a href="#distribution" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-truck-moving"></i><span>Distribution Items</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="distribution" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekeeping.distribution.items.issue.room*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.distribution.items.issue.room')}}">
                                        <i class="las la-list-alt"></i><span>Issue To Room</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekeeping.distribution.items.issue.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.distribution.items.issue.list')}}">
                                        <i class="las la-list-alt"></i><span>Issue List</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekeeping.distribution.items.issue.room.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.distribution.items.issue.room.list')}}">
                                        <i class="las la-list-alt"></i><span>Room Wise Issue</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekeeping.distribution.items.issue.date.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.distribution.items.issue.date.list')}}">
                                        <i class="las la-list-alt"></i><span>Date Wise Issue</span>
                                    </a>
                                </li>

                            
                            </ul>
                        </li>

                        <li class="">
                            <a href="#distributionandmantenance" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <<i class="fas fa-tools"></i><span>Mantinance &Distribution Items</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="distributionandmantenance" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekeeping.maintenance.distribution.items.issue*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.maintenance.distribution.items.issue')}}">
                                        <i class="las la-list-alt"></i><span>Issue To Department</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekeeping.maintenance.distribution.items.issue.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.maintenance.distribution.items.issue.list')}}">
                                        <i class="las la-list-alt"></i><span>Issue List</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekeeping.maintenance.distribution.items.department.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.maintenance.distribution.items.department.list')}}">
                                        <i class="las la-list-alt"></i><span>Department Wise List</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekeeping.maintenance.distribution.date.wise.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekeeping.maintenance.distribution.date.wise.list')}}">
                                        <i class="las la-list-alt"></i><span>Date Wise List</span>
                                    </a>
                                </li>
                            
                            </ul>
                        </li>





                        <li class="">
                            <a href="#acquisition" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-bullhorn"></i><span>Order Acquisition</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="acquisition" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.acquisition.create*') ? 'active' : '' }}">
                                    <a href="{{route('admin.acquisition.create')}}">
                                        <i class="las la-list-alt"></i><span>New Order</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.acquisition.index*') ? 'active' : '' }}">
                                    <a href="{{route('admin.acquisition.index')}}">
                                        <i class="las la-list-alt"></i><span>Order List</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.acquisiton.pending.order.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.acquisiton.pending.order.list')}}">
                                        <i class="las la-list-alt"></i><span>Pending Order List</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.acquisiton.close.order.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.acquisiton.close.order.list')}}">
                                        <i class="las la-list-alt"></i><span>Close Order List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>






                        
                        <li class="">
                            <a href="#reports" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-book-reader"></i><span>Reports</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.housekipping.report.list*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.report.list')}}">
                                        <i class="las la-list-alt"></i><span>HouseKeeping Report</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.housekipping.clean.duration.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.clean.duration.report')}}">
                                        <i class="las la-list-alt"></i><span>Cleaning Duration Analysis</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekipping.day.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.day.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Day Wise Housekeeping</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekipping.room.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.room.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Room Wise Housekeeping</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.housekipping.employee.wise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.housekipping.employee.wise.report')}}">
                                        <i class="las la-list-alt"></i><span>Employee Wise Housekeeping</span>
                                    </a>
                                </li>



                            </ul>
                        </li>









                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>