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


                                <li class="{{ request()->routeIs('admin.restaurant.menu.category*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.menu.category')}}">
                                        <i class="las la-list-alt"></i><span>Menu Category</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.chui.restaurant.menu.config*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.chui.menu.config')}}">
                                        <i class="las la-list-alt"></i><span>Menu Config</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.restaurant.chui.menu.inventory*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.chui.menu.inventory')}}">
                                        <i class="las la-list-alt"></i><span>Menu Inventory</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.restaurant.chui.menu.inventory*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.chui.menu.side')}}">
                                        <i class="las la-list-alt"></i><span>Side Menu</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <!-- reports -->
                    <li class="">
                            <a href="#Reports" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="far fa-user"></i><span>Reports</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="Reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.restaurant.itemwisesell.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.itemwisesell.report')}}">
                                        <i class="las la-list-alt"></i><span>Item-Wise Sell Reports</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.restaurant.categorywise.report*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.categorywise.report')}}">
                                        <i class="las la-list-alt"></i><span>Category-Wise Sell Reports</span>
                                    </a>
                                </li>
                            </ul>
                        </li>





                        <li class="">
                            <a href="#otherinfo" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-info-circle"></i><span>Other Info</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="otherinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                <li class="{{ request()->routeIs('admin.restaurant.menu.Kot.history*') ? 'active' : '' }}">
                                    <a href="{{route('admin.restaurant.menu.Kot.history')}}">
                                        <i class="las la-list-alt"></i><span>KOT History</span>
                                    </a>
                                </li>
                            
                            </ul>
                        </li>



                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>