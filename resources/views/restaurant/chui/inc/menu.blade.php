<div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <a href="{{route('admin.inventory.home')}}" class="header-logo">
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
                        <li class="{{ request()->routeIs('admin.inventory.home*') ? 'active' : '' }}">
                            <a href="{{route('admin.chui.restaurant')}}">
                                <i class="las la-home"></i><span>Home</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#guest_entry" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="far fa-user"></i><span>Menu</span>
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


                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>