<style>
          .footer-menu{
            z-index: 9999;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .activemenu{
            background: #05bbc9;
            color: white;
        }
        .activemenu span{
            color:white;
        }
    </style>
                @php
                    $roleid=Auth::user()->user_role;
                    $access=App\Models\UserRole::where('id',$roleid)->first();
                @endphp
    <div class="container-fluid">

        <div class="row">
            <div class="footer-menu d-flex align-items-center justify-content-between text-center bg-light text-white">
                <nav class="iq-sidebar-menu">

                    <ul id="iq-sidebar-toggle menu_area" class="iq-menu d-flex mn-center slick_slider">


                    @if($access->admin==1)
                        <li class="{{ request()->routeIs('admin.main.dashboard*') ? 'activemenu' : '' }}">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="las la-home"></i><span>Admin</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                        </li>
                    @endif






                    @if($access->front_office==1)
                        <li class="{{ request()->routeIs('admin.hotel*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.hotel')}}">
                                <i class="lab la-uikit iq-arrow-left"></i><span>Front Office</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif

                    @if($access->food_beverage==1)
                        <li class="{{ request()->routeIs('admin.foodandbeverage.create*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.foodandbeverage.create')}}">
                                <i class="las la-network-wired iq-arrow-left"></i><span>Food & Beverage</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif
                    @if($access->house_kipping==1)
                        <li class="{{ request()->routeIs('admin.housekipping.home*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.housekipping.home')}}">
                                <i class="las la-torah iq-arrow-left"></i><span>House Keeping</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif


                    @if($access->restuarent==1)

                        <li class="{{ request()->routeIs('admin.chui.restaurant*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.chui.restaurant')}}">
                                <i class="lab la-uikit iq-arrow-left"></i><span>Restaurant</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif


                    @if($access->payroll==1)
                        <li class="{{ request()->routeIs('admin.payroll.index*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.payroll.index')}}">
                                <i class="las la-network-wired iq-arrow-left"></i><span>Payroll</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif
                       
                     @if($access->banquet==1)
                        <li class="{{ request()->routeIs('admin.banquet.dashboard*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.banquet.dashboard')}}">
                                <i class="las la-torah iq-arrow-left"></i><span>Banquet</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif

                    @if($access->accounts==1)

                        <li class="{{ request()->routeIs('admin.account.home*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.account.home')}}">
                                <i class="lab la-uikit iq-arrow-left"></i><span>Accounts</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif
                    @if($access->inventory==1)
                        <li class="{{ request()->routeIs('admin.inventory.home*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.inventory.home')}}">
                                <i class="las la-network-wired iq-arrow-left"></i><span>Inventory</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif
                    @if($access->stock==1)
                        <li class="{{ request()->routeIs('admin.physicalstock.dashboard*') ? 'activemenu' : '' }}">
                            <a href="{{route('admin.physicalstock.dashboard')}}">
                                <i class="las la-torah iq-arrow-left"></i><span>Stock</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>

                        </li>
                        @endif




                    </ul>



                </nav>
            </div>
        </div>
    </div>