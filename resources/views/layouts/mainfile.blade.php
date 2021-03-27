<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title',$seo->meta_title)</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('public/uploads/logo/'.$logos->favicon)}}" />

    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/backend.css?v=1.0.1">
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
    <link rel="stylesheet" href="{{asset('public/backend')}}/slick.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/slick-theme.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;1,400&display=swap" rel="stylesheet">
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

        .title-area {
            display: block;
            font-family: "Poppins", sans-serif;
            font-size: 30px;
            font-weight: 700;
            color: #374a5e;
        }

        .card_overlay {
            position: relative;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #05bbc9;
        }

        .card_overlay:hover .overlay {
            opacity: .5;
        }

        .overlay h3 {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .slick-arrow{
            padding: 0 1% ;
            line-height: 270%;
            /* border: 1px solid #535f6b; */
            border-radius: 50%;
            margin-right: 10px;
            
        }
    </style>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">



        <div class="bg-analytic-horizontal mb-5">

            <div class="white-bg-menu">
                <div class="iq-menu-horizontal">


                    <nav class="iq-sidebar-menu">
                        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                            <a href="index.html" class="header-logo">
                                <img src="../assets/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                            </a>
                            <div class="iq-menu-bt-sidebar">
                                <i class="las la-bars wrapper-menu"></i>
                            </div>
                        </div>
                        <ul id="iq-sidebar-toggle menu_area" class="iq-menu d-flex mn-center slick_slider">
                            <li class=" ">
                                <a href="#Dashboards" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-home"></i><span>Dashboards</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="Dashboards" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/index.html">
                                            <i class="lab la-blogger-b"></i><span>Dashboard 1</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="../backend/dashboard-2.html">
                                            <i class="las la-share-alt"></i><span>Dashboard 2</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/dashboard-3.html">
                                            <i class="las la-icons"></i><span>Dashboard 3</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="lab la-uikit iq-arrow-left"></i><span>UI Elements</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="ui" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/ui-avatars.html">
                                            <i class="las la-user-tie"></i><span>Avatars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-alerts.html">
                                            <i class="las la-exclamation-triangle"></i><span>Alerts</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-badges.html">
                                            <i class="las la-id-badge"></i><span>Badges</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-breadcrumb.html">
                                            <i class="las la-ellipsis-h"></i><span>Breadcrumb</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons.html">
                                            <i class="las la-ticket-alt"></i><span>Buttons</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons-group.html">
                                            <i class="las la-object-group"></i><span>Buttons Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-boxshadow.html">
                                            <i class="las la-boxes"></i><span>Box Shadow</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-colors.html">
                                            <i class="las la-brush"></i><span>Colors</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-cards.html">
                                            <i class="las la-credit-card"></i><span>Cards</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-carousel.html">
                                            <i class="las la-sliders-h"></i><span>Carousel</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-grid.html">
                                            <i class="las la-th-large"></i><span>Grid</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-helper-classes.html">
                                            <i class="las la-hands-helping"></i><span>Helper classes</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-images.html">
                                            <i class="las la-image"></i><span>Images</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-list-group.html">
                                            <i class="las la-list-alt"></i><span>list Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-media-object.html">
                                            <i class="las la-photo-video"></i><span>Media</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-modal.html">
                                            <i class="las la-columns"></i><span>Modal</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-notifications.html">
                                            <i class="las la-bell"></i><span>Notifications</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-pagination.html">
                                            <i class="las la-ellipsis-h"></i><span>Pagination</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-popovers.html">
                                            <i class="las la-spinner"></i><span>Popovers</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-progressbars.html">
                                            <i class="las la-heading"></i><span>Progressbars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-typography.html">
                                            <i class="las la-tablet"></i><span>Typography</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tabs.html">
                                            <i class="las la-tablet"></i><span>Tabs</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tooltips.html">
                                            <i class="las la-magnet"></i><span>Tooltips</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-embed-video.html">
                                            <i class="las la-play-circle"></i><span>Video</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#plugin" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-network-wired iq-arrow-left"></i><span>Plugins</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="plugin" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/plugin-rating.html">
                                            <i class="las la-smile"></i><span>Rating</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-tree-view.html">
                                            <i class="las la-seedling"></i><span>Treeview</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-sweetalert.html">
                                            <i class="las la-cookie"></i><span>Sweetalert</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-loader.html">
                                            <i class="las la-redo-alt"></i><span>Loader</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-torah iq-arrow-left"></i><span>Authentication</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="auth" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/auth-sign-in.html">
                                            <i class="las la-sign-in-alt"></i><span>Login</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-sign-up.html">
                                            <i class="las la-registered"></i><span>Register</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-recoverpw.html">
                                            <i class="las la-unlock-alt"></i><span>Recover Password</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-confirm-mail.html">
                                            <i class="las la-envelope-square"></i><span>Confirm Mail</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-lock-screen.html">
                                            <i class="las la-lock"></i><span>Lock Screen</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>




                            <li class=" ">
                                <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="lab la-uikit iq-arrow-left"></i><span>UI Elements</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="ui" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/ui-avatars.html">
                                            <i class="las la-user-tie"></i><span>Avatars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-alerts.html">
                                            <i class="las la-exclamation-triangle"></i><span>Alerts</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-badges.html">
                                            <i class="las la-id-badge"></i><span>Badges</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-breadcrumb.html">
                                            <i class="las la-ellipsis-h"></i><span>Breadcrumb</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons.html">
                                            <i class="las la-ticket-alt"></i><span>Buttons</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons-group.html">
                                            <i class="las la-object-group"></i><span>Buttons Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-boxshadow.html">
                                            <i class="las la-boxes"></i><span>Box Shadow</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-colors.html">
                                            <i class="las la-brush"></i><span>Colors</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-cards.html">
                                            <i class="las la-credit-card"></i><span>Cards</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-carousel.html">
                                            <i class="las la-sliders-h"></i><span>Carousel</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-grid.html">
                                            <i class="las la-th-large"></i><span>Grid</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-helper-classes.html">
                                            <i class="las la-hands-helping"></i><span>Helper classes</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-images.html">
                                            <i class="las la-image"></i><span>Images</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-list-group.html">
                                            <i class="las la-list-alt"></i><span>list Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-media-object.html">
                                            <i class="las la-photo-video"></i><span>Media</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-modal.html">
                                            <i class="las la-columns"></i><span>Modal</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-notifications.html">
                                            <i class="las la-bell"></i><span>Notifications</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-pagination.html">
                                            <i class="las la-ellipsis-h"></i><span>Pagination</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-popovers.html">
                                            <i class="las la-spinner"></i><span>Popovers</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-progressbars.html">
                                            <i class="las la-heading"></i><span>Progressbars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-typography.html">
                                            <i class="las la-tablet"></i><span>Typography</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tabs.html">
                                            <i class="las la-tablet"></i><span>Tabs</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tooltips.html">
                                            <i class="las la-magnet"></i><span>Tooltips</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-embed-video.html">
                                            <i class="las la-play-circle"></i><span>Video</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#plugin" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-network-wired iq-arrow-left"></i><span>Plugins</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="plugin" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/plugin-rating.html">
                                            <i class="las la-smile"></i><span>Rating</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-tree-view.html">
                                            <i class="las la-seedling"></i><span>Treeview</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-sweetalert.html">
                                            <i class="las la-cookie"></i><span>Sweetalert</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-loader.html">
                                            <i class="las la-redo-alt"></i><span>Loader</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-torah iq-arrow-left"></i><span>Authentication</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="auth" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/auth-sign-in.html">
                                            <i class="las la-sign-in-alt"></i><span>Login</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-sign-up.html">
                                            <i class="las la-registered"></i><span>Register</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-recoverpw.html">
                                            <i class="las la-unlock-alt"></i><span>Recover Password</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-confirm-mail.html">
                                            <i class="las la-envelope-square"></i><span>Confirm Mail</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-lock-screen.html">
                                            <i class="las la-lock"></i><span>Lock Screen</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class=" ">
                                <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="lab la-uikit iq-arrow-left"></i><span>UI Elements</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="ui" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/ui-avatars.html">
                                            <i class="las la-user-tie"></i><span>Avatars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-alerts.html">
                                            <i class="las la-exclamation-triangle"></i><span>Alerts</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-badges.html">
                                            <i class="las la-id-badge"></i><span>Badges</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-breadcrumb.html">
                                            <i class="las la-ellipsis-h"></i><span>Breadcrumb</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons.html">
                                            <i class="las la-ticket-alt"></i><span>Buttons</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-buttons-group.html">
                                            <i class="las la-object-group"></i><span>Buttons Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-boxshadow.html">
                                            <i class="las la-boxes"></i><span>Box Shadow</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-colors.html">
                                            <i class="las la-brush"></i><span>Colors</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-cards.html">
                                            <i class="las la-credit-card"></i><span>Cards</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-carousel.html">
                                            <i class="las la-sliders-h"></i><span>Carousel</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-grid.html">
                                            <i class="las la-th-large"></i><span>Grid</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-helper-classes.html">
                                            <i class="las la-hands-helping"></i><span>Helper classes</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-images.html">
                                            <i class="las la-image"></i><span>Images</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-list-group.html">
                                            <i class="las la-list-alt"></i><span>list Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-media-object.html">
                                            <i class="las la-photo-video"></i><span>Media</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-modal.html">
                                            <i class="las la-columns"></i><span>Modal</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-notifications.html">
                                            <i class="las la-bell"></i><span>Notifications</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-pagination.html">
                                            <i class="las la-ellipsis-h"></i><span>Pagination</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-popovers.html">
                                            <i class="las la-spinner"></i><span>Popovers</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-progressbars.html">
                                            <i class="las la-heading"></i><span>Progressbars</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-typography.html">
                                            <i class="las la-tablet"></i><span>Typography</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tabs.html">
                                            <i class="las la-tablet"></i><span>Tabs</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-tooltips.html">
                                            <i class="las la-magnet"></i><span>Tooltips</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/ui-embed-video.html">
                                            <i class="las la-play-circle"></i><span>Video</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#plugin" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-network-wired iq-arrow-left"></i><span>Plugins</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="plugin" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/plugin-rating.html">
                                            <i class="las la-smile"></i><span>Rating</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-tree-view.html">
                                            <i class="las la-seedling"></i><span>Treeview</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-sweetalert.html">
                                            <i class="las la-cookie"></i><span>Sweetalert</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/plugin-loader.html">
                                            <i class="las la-redo-alt"></i><span>Loader</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" ">
                                <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <i class="las la-torah iq-arrow-left"></i><span>Authentication</span>
                                    <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                    <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                </a>
                                <ul id="auth" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                                    <li class=" ">
                                        <a href="../backend/auth-sign-in.html">
                                            <i class="las la-sign-in-alt"></i><span>Login</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-sign-up.html">
                                            <i class="las la-registered"></i><span>Register</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-recoverpw.html">
                                            <i class="las la-unlock-alt"></i><span>Recover Password</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-confirm-mail.html">
                                            <i class="las la-envelope-square"></i><span>Confirm Mail</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../backend/auth-lock-screen.html">
                                            <i class="las la-lock"></i><span>Lock Screen</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>




                        </ul>



                    </nav>
                </div>
            </div>

        </div>






        <div class="container">


            <div class="row">





                <div class="col-md-6 col-lg-3 col-sm-6">
                    <a href="">
                        <div class="card card-block card-stretch card-height card_overlay">
                            <div class="card-body p-0">
                                <div class="top-block-one text-center">
                                    <div class="">
                                        <img src="{{asset('public/backend/assets/admin/admin.jpg')}}" alt="" class="w-100" />
                                    </div>
                                    <div class="mt-4">
                                        <h3 class="mb-1 title-area">Admin</h3>
                                    </div>
                                </div>
                                <div class="overlay">

                                </div>
                            </div>
                        </div>

                    </a>
                </div>



                <div class="col-md-6 col-lg-3 col-sm-6">
                    <a href="">
                        <div class="card card-block card-stretch card-height card_overlay">
                            <div class="card-body p-0">
                                <div class="top-block-one text-center">
                                    <div class="">
                                        <img src="{{asset('public/backend/assets/admin/front-office.jpg')}}" alt="" class="w-100" />
                                    </div>
                                    <div class="mt-4">
                                        <h3 class="mb-1 title-area">Front Office</h3>
                                    </div>
                                </div>
                                <div class="overlay">

                                </div>
                            </div>
                        </div>

                    </a>
                </div>



                <div class="col-md-6 col-lg-3 col-sm-6">
                    <a href="">
                        <div class="card card-block card-stretch card-height card_overlay">
                            <div class="card-body p-0">
                                <div class="top-block-one text-center">
                                    <div class="">
                                        <img src="{{asset('public/backend/assets/admin/foodandbav.jpg')}}" alt="" class="w-100" />
                                    </div>
                                    <div class="mt-4">
                                        <h3 class="mb-1 title-area">Food & Beverage</h3>
                                    </div>
                                </div>
                                <div class="overlay">

                                </div>
                            </div>
                        </div>

                    </a>
                </div>



                <div class="col-md-6 col-lg-3 col-sm-6">
                    <a href="">
                        <div class="card card-block card-stretch card-height card_overlay">
                            <div class="card-body p-0">
                                <div class="top-block-one text-center">
                                    <div class="">
                                        <img src="{{asset('public/backend/assets/admin/housekeeping.jpg')}}" alt="" class="w-100" />
                                    </div>
                                    <div class="mt-4">
                                        <h3 class="mb-1 title-area">House Keeping</h3>
                                    </div>
                                </div>
                                <div class="overlay">

                                </div>
                            </div>
                        </div>

                    </a>
                </div>











            </div>











        </div>


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

        <!-- alert -->
        <script src="{{asset('public/backend')}}/assets/js/izitost.js"></script>

        <script>
            @if(Session::has('messege'))
            var type = "{{Session::get('alert-type','info')}}"
            switch (type) {
                case 'success':

                    iziToast.success({
                        message: '{{ Session::get('
                        messege ') }}',
                        'position': 'topCenter'
                    });
                    brack;
                case 'info':
                    iziToast.info({
                        message: '{{ Session::get('
                        messege ') }}',
                        'position': 'topRight'
                    });
                    brack;
                case 'warning':
                    iziToast.warning({
                        message: '{{ Session::get('
                        messege ') }}',
                        'position': 'topRight'
                    });
                    break;
                case 'error':
                    iziToast.error({
                        message: '{{ Session::get('
                        messege ') }}',
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

        <script src="{{asset('public/backend')}}/assets/js/app.js"></script>
        <script src="{{asset('public/backend')}}/slick.js"></script>
        <script>
            $(document).ready(function() {


                $('.slick_slider').slick({
                    slidesToShow: 8,
                    slidesToScroll: 8,
                    infinite: true,
                    speed: 300,
                    nextArrow: '<i class="fas fa-arrow-right"></i>',
                    prevArrow: '<i class="fas fa-arrow-left"></i>'
                });
            });
        </script>


</body>

</html>