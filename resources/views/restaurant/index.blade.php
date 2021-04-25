<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title',$seo->meta_title)</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('public/uploads/logo/'.$logos->favicon)}}" />

    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/backend.css?v=1.0.1">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->


    <script src="{{asset('public/backend')}}/assets/js/select2.js"></script>
    <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/select2.css">
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

        .mt-40 {
            margin-top: 15%;
        }

        .wrapper {
            height: calc(100vh);
            display: block;
            padding-top: 12%;
        }

        .resturent_btn {
            position: absolute;
            top: 45%;
            left: 37%;
            z-index: 99999;
        }
    </style>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Choose Restaurant</h4>
                            </div>
                            <div class="btn-group btn-group-toggle">

                                <a class="button btn button-icon btn-outline-primary" href="{{route('admin.dashboard')}}">Go Back</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">




                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-m mt-2">
                                    <div class="hover-effects">
                                        <a>
                                            <img src="{{asset('public/')}}/uploads/restaurant/chui.jpg" class="img-fluid rounded effect-1 w-100" alt="" />
                                        </a>

                                    </div>
                                    <div class="btn-group btn-group-toggle resturent_btn">
                                        <a class="btn btn-primary" href="{{route('admin.chui.restaurant')}}">CHUI RESTAURANT</a>
                                    </div>


                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 grid-m mt-2">
                                    <div class="hover-effects">
                                        <a>
                                            <img src="{{asset('public/')}}/uploads/restaurant/chrengeti.jpg" class="img-fluid rounded effect-1 w-100" alt="" />
                                        </a>

                                    </div>
                                    <div class="btn-group btn-group-toggle resturent_btn">
                                        <a class="btn btn-info text-white" href="#">SERENGETI RESTAURANT</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/backend-bundle.min.js"></script>

    <script src="{{asset('public/backend')}}/assets/js/app.js"></script>

</body>

</html>