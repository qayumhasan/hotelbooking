
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>@yield('title',$seo->meta_title)</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('public/uploads/logo/'.$logos->favicon)}}"/>

      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/backend.css?v=1.0.1">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/@icon/dripicons/dripicons.css">

      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/core/main.css" />
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/daygrid/main.css" />
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/timegrid/main.css"/>
      <link rel='stylesheet' href="{{asset('public/backend')}}/assets/vendor/fullcalendar/list/main.css"/>
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/vendor/mapbox/mapbox-gl.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/izitost.css">
      <link rel="stylesheet" href="{{asset('public/backend')}}/assets/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

   
  

    <div class="content-page">
         <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <a href="{{url('admin/dashboard')}}"><h3 class="text-danger">Admin</h3></a>
                                    <div class="bg-danger icon iq-icon-box-2 mr-2 rounded">
                                        <i class="lar la-hand-pointer"></i>
                                    </div>
                                </div>
                              
                                <div class="mt-1">
                              
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-danger" data-percent="55"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                               <a href="{{route('admin.hotel')}}"> <h3 class="text-primary">Hotels</h3></a>
                                <div class="bg-primary icon iq-icon-box-2 mr-2 rounded">
                                    <i class="lar la-folder-open"></i>
                                </div>
                                </div>
                             
                                <div class="mt-1">
                               
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-primary" data-percent="67"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('admin.inventory.home')}}"><h3 class="text-info">Inventory</h3></a>
                                <div class="bg-info icon iq-icon-box-2 mr-2 rounded">
                                    <i class="lar la-envelope"></i>
                                </div>
                                </div>
                                
                                <div class="mt-1">
                              
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-info" data-percent="85"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                             <a href="{{route('admin.foodandbeverage.create')}}"><h3 class="text-orange">Food And Beverage</h3></a>
                                <div class="bg-orange icon iq-icon-box-2 mr-2 rounded">
                                    <i class="las la-desktop"></i>
                                </div>
                                </div>
                               
                                <div class="mt-1">
                               
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-orange" data-percent="55" ></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('admin.housekipping.home')}}">
                                    <h3 class="text-skyblue">House Kipping</h3>
                                </a>
                                <div class="bg-skyblue icon iq-icon-box-2 mr-2 rounded">
                                    <i class="las la-exclamation-triangle"></i>
                                </div>
                                </div>
                              
                                <div class="mt-1">
                                   
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-skyblue" data-percent="33"></span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                             <a href="{{route('admin.banquet.index')}}"><h3 class="text-success">Banquet</h3></a>
                                <div class="bg-success icon iq-icon-box-2 mr-2 rounded">
                                    <i class="las la-circle-notch"></i>
                                </div>
                                </div>
                            
                                <div class="mt-1">
                                
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-success" data-percent="33"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">


                                <a href="{{route('admin.restaurant.index')}}"><h3 class="text-info">Restaurant</h3></a>

                               

                                <div class="bg-info icon iq-icon-box-2 mr-2 rounded">
                                <i class="las la-cocktail"></i>
                                    
                                </div>
                                </div>
                               
                                <div class="mt-1">
                               
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-info" data-percent="85"></span>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('admin.payroll.index')}}"><h3 class="text-info">Payroll</h3></a>
                                <div class="bg-info icon iq-icon-box-2 mr-2 rounded">
                                    <i class="lar la-envelope"></i>
                                </div>
                                </div>
                              
                                <div class="mt-1">
                               
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-info" data-percent="85"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <h3 class="text-info">CRM</h3>
                                <div class="bg-info icon iq-icon-box-2 mr-2 rounded">
                                    <i class="lar la-envelope"></i>
                                </div>
                                </div>
                                
                                <div class="mt-1">
                               
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-info" data-percent="85"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="top-block d-flex align-items-center justify-content-between mb-3">
                                <h3 class="text-info">Edocuments</h3>
                                <div class="bg-info icon iq-icon-box-2 mr-2 rounded">
                                    <i class="lar la-envelope"></i>
                                </div>
                                </div>
                              
                                <div class="mt-1">
                                
                                </div>
                                <div class="iq-progress-bar mt-3">
                                <span class="bg-info" data-percent="85"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
              
            </div>
            <!-- Page end  -->
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
                    message: '{{ Session::get('messege') }}',
                    'position':'topCenter'
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
  </body>
</html>
