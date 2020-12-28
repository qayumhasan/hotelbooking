
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin Login</title>

      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('public/backend')}}/assets/images/favicon.ico" />

      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/backend.css?v=1.0.1">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@icon/dripicons/dripicons.css">

      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/core/main.css"/>
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/daygrid/main.css"/>
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/timegrid/main.css" />
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/list/main.css" />
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/mapbox/mapbox-gl.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/izitost.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
  <body class=" ">
    <!-- loader Start -->
 <!--    <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->

      <div class="wrapper">
      <section class="login-content">
         <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
               <div class="col-12">
                  <div class="row align-items-center">
                     <div class="col-lg-6">
                        <h2 class="mb-2">Sign In</h2>
                        <p>To Keep connected with us please login with your personal info.</p>
                        <form action="{{route('admin.login')}}" method="post">
                          @csrf
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="floating-label form-group">

                                    <input name="email" class="floating-input form-control" type="text" placeholder=" ">
                                    <label>Email</label>
                                    @error('email')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="floating-label form-group">

                                     <input name="password" class="floating-input form-control" type="password" placeholder=" ">
                                    <label>Password</label>
                                     @error('password')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <a href="{{url('admin/forget/password')}}" class="text-primary float-right">Forgot Password?</a>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Sign In</button>
                         <!--   <p class="mt-3">
                              Create an Account <a href="auth-sign-up.html" class="text-primary">Sign Up</a>
                           </p> -->
                        </form>
                     </div>
                     @php
                      $logos=App\Models\Logo::first();
                     @endphp
                     <div class="col-lg-6 mb-lg-0 mb-4 mt-lg-0 mt-4">
                        <img src="{{asset('public/uploads/logo/'.$logos->Lazy_loader)}}" class="img-fluid w-80" alt="">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/backend-bundle.min.js"></script>

    <!-- Flextree Javascript-->
    <script src="{{asset('public/backend')}}/assets/js/flex-tree.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/tree.js"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/table-treeview.js"></script>

    <!-- Masonary Gallery Javascript -->
    <script src="{{asset('public/backend')}}/assets/js/masonry.pkgd.min.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/imagesloaded.pkgd.min.js"></script>

    <!-- Mapbox Javascript -->
    <script src="{{asset('public/backend')}}/assets/js/mapbox-gl.js"></script>
    <script src="{{asset('public/backend')}}/assets/js/mapbox.js"></script>

    <!-- Fullcalender Javascript -->
    <script src="{{asset('public/backend')}}/assets/vendor/fullcalendar/core/main.js"></script>
    <script src="{{asset('public/backend')}}/assets/vendor/fullcalendar/daygrid/main.js"></script>
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
    <script src="{{asset('public/backend')}}/assets/js/izitost.js"></script>
    <script>
        @if(Session::has('messege'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'success':

                iziToast.success({
                    message: '{{ Session::get('messege') }}',
                    'position':'topRight'
                });
                brack;
            case 'info':
                iziToast.info({
                    message: '{{ Session::get('messege') }}',
                    'position':'topRight'
                });
                brack;
            case 'warning':
                iziToast.warning({
                    message: '{{ Session::get('messege') }}',
                    'position':'topRight'
                });
                break;
            case 'error':
                iziToast.error({
                    message: '{{ Session::get('messege') }}',
                    'position':'topRight'
                });
                break;
        }
        @endif
    </script>
    <!-- app JavaScript -->
    <script src="{{asset('public/backend')}}/assets/js/app.js"></script>
  </body>
</html>
