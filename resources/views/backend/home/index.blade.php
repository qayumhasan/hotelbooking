@extends('layouts.admin')
@section('title', 'Dashboard | '.$seo->meta_title)
@section('content')
<div class="content-page">
         <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="d-flex align-items-center justify-content-between welcome-content">
                        <div class="navbar-breadcrumb">
                            <h4 class="mb-0">Welcome To Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-success rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s"> <i class="fa fa-bed" aria-hidden="true"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Available Room</h6>
                              <h3 class="text-white">{{$availableRoom}}</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
                <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-primary rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-primary rounded shadow" data-wow-delay="0.2s"> <i class="fa fa-bed" aria-hidden="true"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Housekeeping Room</h6>
                              <h3 class="text-white">{{$houseKippingRoom}}</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-warning rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-warning rounded shadow" data-wow-delay="0.2s"> <i class="fa fa-bed" aria-hidden="true"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Maintenance Room</h6>
                              <h3 class="text-white">{{$maintanceRoom}}</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-danger rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s"><i class="fa fa-bed" aria-hidden="true"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Booking Room</h6>
                              <h3 class="text-white">{{$bookingRoom}}</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--  -->
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-primary-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-primary"><i class="fa fa-users" aria-hidden="true"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">{{$employee}}</span></h2>
                              <h5 class="">Employee</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-warning-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-warning"><i class="fa fa-user" aria-hidden="true"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">{{$user}}</span></h2>
                              <h5 class="">User</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-danger-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-danger"><i class="fa fa-user-circle" aria-hidden="true"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">{{$supplier}}</span></h2>
                              <h5 class="">Supplier</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-info-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-info"><i class="fa fa-user-secret" aria-hidden="true"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">{{$guest}}</span></h2>
                              <h5 class="">Guest</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

                <!--  -->
              
              
                <div class="col-lg-8">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header border-none">
                            <div class="header-title">
                                <h4 class="card-title">Statistics</h4>
                            </div>
                        </div>
                    <div class="card-body">
                        <div id="layout-1-chart-03"></div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-wrap p-0">
                  <div class="col-md-6">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-12 mb-2 d-flex justify-content-between">
                                 <div class="icon iq-icon-box rounded bg-primary rounded shadow" data-wow-delay="0.2s"> <i class="las la-users"></i>
                                 </div>
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <h6 class="card-title text-uppercase text-secondary mb-0">Customer</h6>
                                 <span class="h2 mb-0 counter d-inline-block w-100">60,586</span>
                              </div>
                           </div>
                           <p class="mb-0 mt-3"> <span class="badge badge-primary mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-12 mb-2 d-flex justify-content-between">
                                 <div class="icon iq-icon-box rounded bg-warning rounded shadow" data-wow-delay="0.2s"> <i class="las la-balance-scale"></i>
                                 </div>
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <h6 class="card-title text-uppercase text-secondary mb-0">Sales</h6>
                                 <span class="h2 mb-0 counter d-inline-block w-100">80,586</span>
                              </div>
                           </div>
                           <p class="mb-0 mt-3"> <span class="badge badge-warning mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-12 mb-2 d-flex justify-content-between">
                                 <div class="icon iq-icon-box rounded bg-info rounded shadow" data-wow-delay="0.2s"> <i class="las la-plus-circle"></i>
                                 </div>
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <h6 class="card-title text-uppercase text-secondary mb-0">Profit</h6>
                                 <span class="h2 mb-0 d-inline-block w-100"><span class="counter">80</span>%</span>
                              </div>
                           </div>
                           <p class="mb-0 mt-3"> <span class="badge badge-info mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-12 mb-2 d-flex justify-content-between">
                                 <div class="icon iq-icon-box rounded bg-danger rounded shadow" data-wow-delay="0.2s"> <i class="las la-minus-circle"></i>
                                 </div>
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <h6 class="card-title text-uppercase text-secondary mb-0">Loss</h6>
                                 <span class="h2 mb-0 d-inline-block w-100"><span class="counter">15</span>%</span>
                              </div>
                           </div>
                           <p class="mb-0 mt-3"> <span class="badge badge-danger mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               

               
            </div>
            <!-- Page end  -->
        </div>
      </div>
    @endsection