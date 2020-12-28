@extends('hotelbooking.master')
@section('content')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height overflow-hidden" style="position: relative;">
                     <div class="card-body pb-0">
                        <div class="rounded iq-card-icon bg-primary-light"><i class="ri-exchange-dollar-fill"></i>
                        </div> <span class="float-right line-height-6">Net Worth</span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                           <h2 class="mb-0"><span class="counter">65</span><span>M</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">10%</span> Increased</p>
                        </div>
                     </div>
                     <div id="chart-1"></div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height overflow-hidden" style="position: relative;">
                     <div class="card-body pb-0">
                        <div class="rounded iq-card-icon bg-warning-light"><i class="ri-bar-chart-grouped-line"></i>
                        </div> <span class="float-right line-height-6">Todays Gains</span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                           <h2 class="mb-0"><span>$</span><span class="counter">4500</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">20%</span> Increased</p>
                        </div>
                     </div>
                     <div id="chart-2"></div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height overflow-hidden" style="position: relative;">
                     <div class="card-body pb-0">
                        <div class="rounded iq-card-icon bg-success-light"><i class="ri-group-line"></i>
                        </div> <span class="float-right line-height-6">Total Users</span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                           <h2 class="mb-0"><span class="counter">96.6</span><span>K</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">30%</span> Increased</p>
                        </div>
                     </div>
                     <div id="chart-3"></div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height overflow-hidden" style="position: relative;">
                     <div class="card-body pb-0">
                        <div class="rounded iq-card-icon bg-danger-light"><i class="ri-shopping-cart-line"></i>
                        </div> <span class="float-right line-height-6">Orders Received</span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                           <h2 class="mb-0"><span class="counter">15.5</span><span>K</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-down-line text-danger mr-1"></i><span class="text-danger">10%</span> Increased</p>
                        </div>
                     </div>
                     <div id="chart-4"></div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-box-absolute icon iq-icon-box rounded bg-primary-light"> <i class="ri-focus-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Sales</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                           <h5><b>$18 378</b></h5>
                           <div id="iq-chart-box1"></div> <span class="text-primary"><b> +14% <i class="ri-arrow-up-fill"></i></b></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-box-absolute icon iq-icon-box rounded bg-danger-light"> <i class="ri-pantone-line"></i>
                           </div>
                           <p class="text-secondary">Sales Today</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                           <h5><b>$190</b></h5>
                           <div id="iq-chart-box2"></div> <span class="text-danger"><b> -6% <i class="ri-arrow-down-fill"></i></b></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-box-absolute icon iq-icon-box rounded bg-success-light"> <i class="ri-database-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Classon</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                           <h5><b>45</b></h5>
                           <div id="iq-chart-box3"></div> <span class="text-success"><b> +0.36% <i class="ri-arrow-up-fill"></i></b></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="iq-box-absolute icon iq-icon-box rounded bg-warning-light"> <i class="ri-pie-chart-2-line"></i>
                           </div>
                           <p class="text-secondary">Total Profit</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                           <h5><b>60</b></h5>
                           <div id="iq-chart-box4"></div> <span class="text-warning"><b> +0.45% <i class="ri-arrow-up-fill"></i></b></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Invoice Sent</h6>
                           <span class="iq-icon"><i class="ri-information-fill"></i></span>
                        </div>
                        <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
                           <div class="d-flex align-items-center">
                              <div class="rounded iq-card-icon bg-primary-light mr-2"> <i class="ri-inbox-fill"></i>
                              </div>
                              <h2>352</h2>
                           </div>
                           <div class="iq-map text-primary font-size-32"><i class="ri-bar-chart-grouped-line"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Credited From Accounts</h6>
                           <span class="iq-icon"><i class="ri-information-fill"></i></span>
                        </div>
                        <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
                           <div class="d-flex align-items-center">
                              <div class="rounded iq-card-icon bg-danger-light mr-2"><i class="ri-radar-line"></i>
                              </div>
                              <h2>$37k</h2>
                           </div>
                           <div class="iq-map text-danger font-size-32"><i class="ri-bar-chart-grouped-line"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>AVG Employee Costs</h6>
                           <span class="iq-icon"><i class="ri-information-fill"></i></span>
                        </div>
                        <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
                           <div class="d-flex align-items-center">
                              <div class="rounded iq-card-icon bg-warning-light mr-2"><i class="ri-price-tag-3-line"></i>
                              </div>
                              <h2>32%</h2>
                           </div>
                           <div class="iq-map text-warning font-size-32"><i class="ri-bar-chart-grouped-line"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Average payment delay</h6>
                           <span class="iq-icon"><i class="ri-information-fill"></i></span>
                        </div>
                        <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
                           <div class="d-flex align-items-center">
                              <div class="rounded iq-card-icon bg-info-light mr-2"><i class="ri-refund-line"></i>
                              </div>
                              <h2>27h</h2>
                           </div>
                           <div class="iq-map text-info font-size-32"><i class="ri-bar-chart-grouped-line"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="iq-service d-flex align-items-center justify-content-between" style="position: relative;">
                           <div class="service-data">
                              <h3>24%</h3>
                              <p class="mb-0">Service used</p>
                           </div>
                           <div id="service-chart-01"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="iq-service d-flex align-items-center justify-content-between" style="position: relative;">
                           <div class="service-data">
                              <h3>2.5</h3>
                              <p class="mb-0">GB Stored</p>
                           </div>
                           <div id="service-chart-02"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="iq-service d-flex align-items-center justify-content-between" style="position: relative;">
                           <div class="service-data">
                              <h3>351</h3>
                              <p class="mb-0">user collect</p>
                           </div>
                           <div id="service-chart-03"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body iq-box-relative">
                        <div class="iq-service d-flex align-items-center justify-content-between" style="position: relative;">
                           <div class="service-data">
                              <h3>4,852</h3>
                              <p class="mb-0">Visitors</p>
                           </div>
                           <div id="service-chart-04"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 row m-0 p-0 iq-duration-block">
                  <div class="col-sm-6 col-md-2 col-lg-2">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <div class="icon iq-icon-box bg-primary-light rounded"> <i class="ri-drag-move-2-fill"></i>
                           </div>
                           <div class="mt-4">
                              <h2>2.14s</h2>
                              <p>Frontend time</p>
                           </div>
                           <div id="ethernet-chart-01"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-2 col-lg-2">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <div class="icon iq-icon-box bg-success-light rounded" data-wow-delay="0.2s"> <i class="ri-artboard-2-line"></i>
                           </div>
                           <div class="mt-4">
                              <h2>1.05s</h2>
                              <p>Backend time</p>
                           </div>
                           <div id="ethernet-chart-02"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-2 col-lg-2">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <div class="icon iq-icon-box bg-danger-light rounded" data-wow-delay="0.2s"> <i class="ri-map-pin-time-line"></i>
                           </div>
                           <div class="mt-4">
                              <h2>0.25s</h2>
                              <p>Local time</p>
                           </div>
                           <div id="ethernet-chart-03"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-2 col-lg-2">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <div class="icon iq-icon-box bg-primary rounded" data-wow-delay="0.2s"> <i class="ri-timer-line"></i>
                           </div>
                           <div class="mt-4">
                              <h2>3.07s</h2>
                              <p>Processing time</p>
                           </div>
                           <div id="ethernet-chart-04"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-4">
                     <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                           <h4 class="text-uppercase text-black mb-0">Session(Now)</h4>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="font-size-80 text-black">12</div>
                              <div class="text-left">
                                 <p class="m-0 text-uppercase font-size-12">1 Hours Ago</p>
                                 <div class="mb-1 text-black">1500<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>3.25%</span>
                                 </div>
                                 <p class="m-0 text-uppercase font-size-12">1 Day Ago</p>
                                 <div class="mb-1 text-black">1890<span class="text-success"><i class="ri-arrow-down-s-fill"></i>1.00%</span>
                                 </div>
                                 <p class="m-0 text-uppercase font-size-12">1 Week Ago</p>
                                 <div class="text-black">1260<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>9.87%</span>
                                 </div>
                              </div>
                           </div>
                           <div id="chart-9"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection