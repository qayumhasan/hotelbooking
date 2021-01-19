@extends('inventory.master')
@section('content')
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="text-center"><span>AVG Impressions</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="value-box">
                              <h2 class="mb-0"><span class="counter">2.648</span></h2>
                              <p class="mb-0 text-secondary line-height">26.84%</p>
                           </div>
                           <div class="iq-iconbox bg-danger-light"> <i class="ri-arrow-down-line"></i>
                           </div>
                        </div>
                        <div class="iq-progress-bar mt-5"> <span class="bg-danger" data-percent="80"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="text-center"><span>AVG Engagements Rate</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="value-box">
                              <h2 class="mb-0"><span class="counter">89.6</span></h2>
                              <p class="mb-0 pl-2 text-secondary line-height">8.64%</p>
                           </div>
                           <div class="iq-iconbox bg-info-light"> <i class="ri-arrow-up-line"></i>
                           </div>
                        </div>
                        <div class="iq-progress-bar mt-5"> <span class="bg-info" data-percent="50"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="text-center"><span>AVG Reach</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="value-box">
                              <h2 class="mb-0"><span class="counter">826</span></h2>
                              <p class="mb-0 pl-2 text-secondary line-height">0.86%</p>
                           </div>
                           <div class="iq-iconbox bg-success-light"> <i class="ri-arrow-up-line"></i>
                           </div>
                        </div>
                        <div class="iq-progress-bar mt-5"> <span class="bg-success" data-percent="66"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <div class="text-center"><span>AVG Transport</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="value-box">
                              <h2 class="mb-0"><span class="counter">7.55</span></h2>
                              <p class="mb-0 pl-2 text-secondary line-height">25.5%</p>
                           </div>
                           <div class="iq-iconbox bg-primary-light"> <i class="ri-arrow-up-line"></i>
                           </div>
                        </div>
                        <div class="iq-progress-bar mt-5"> <span class="bg-primary" data-percent="70"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-primary-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-primary"><i class="ri-user-fill"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">5600</span></h2>
                              <h5 class="">Doctors</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-warning-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-warning"><i class="ri-women-fill"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">3450</span></h2>
                              <h5 class="">Nurses</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-danger-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-danger"><i class="ri-group-fill"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">3500</span></h2>
                              <h5 class="">Patients</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body bg-info-light rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded iq-card-icon bg-info"><i class="ri-hospital-line"></i>
                           </div>
                           <div class="text-right">
                              <h2 class="mb-0"><span class="counter">4500</span></h2>
                              <h5 class="">Pharmacists</h5>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-primary rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-primary rounded shadow" data-wow-delay="0.2s"> <i class="las la-users"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Customers</h6>
                              <h3 class="text-white">75</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-warning rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-warning rounded shadow" data-wow-delay="0.2s"> <i class="lab la-product-hunt"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Products</h6>
                              <h3 class="text-white">60</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-success rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s"> <i class="las la-user-tie"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">User</h6>
                              <h3 class="text-white">80</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height bg-danger rounded">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s"> <i class="lab la-buffer"></i>
                           </div>
                           <div class="iq-text">
                              <h6 class="text-white">Category</h6>
                              <h3 class="text-white">45</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height iq-border-box iq-border-box-1 text-primary">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Worked Today</h6>
                           <h5>08:00 Hr</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height iq-border-box iq-border-box-2 text-warning">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Worked This Week</h6>
                           <h5>40:00 Hr</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height iq-border-box iq-border-box-3 text-danger">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Worked Issue</h6>
                           <h5>1200</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="card card-block card-stretch card-height iq-border-box iq-border-box-4 text-info">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                           <h6>Worked Income</h6>
                           <h5>$54000</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="card card-block card-stretch card-height">
                     <div class="card-body">
                        <h2 class="mb-0"><span>$</span><span class="counter">3450</span></h2>
                        <p class="mb-0">Your Current Balance</p>
                        <h6 class="mb-4"><span class="text-success">20%</span> ($520)</h6>
                        <a href="javascript:void();" class="btn btn-danger d-block mt-5 mb-5"> Add Credit</a>
                        <div class="mt-2">
                           <div class="d-flex align-items-center justify-content-between">
                              <p class="mt-1 mb-2">Insurance</p>
                              <h4 class="counter">81</h4> 
                           </div>
                           <div class="iq-progress-bar-linear d-inline-block mt-0 w-100">
                              <div class="iq-progress-bar"> <span class="bg-primary" data-percent="60"></span>
                              </div>
                           </div>
                        </div>
                        <div class="mt-2">
                           <div class="d-flex align-items-center justify-content-between">
                              <p class="mt-1 mb-2">Savings</p>
                              <h4 class="counter">124</h4> 
                           </div>
                           <div class="iq-progress-bar-linear d-inline-block mt-0 w-100">
                              <div class="iq-progress-bar"> <span class="bg-success" data-percent="70"></span>
                              </div>
                           </div>
                        </div>
                        <div class="mt-2">
                           <div class="d-flex align-items-center justify-content-between">
                              <p class="mt-1 mb-2">Investment</p>
                              <h4 class="counter">74</h4> 
                           </div>
                           <div class="iq-progress-bar-linear d-inline-block mt-0 w-100">
                              <div class="iq-progress-bar"> <span class="bg-info" data-percent="50"></span>
                              </div>
                           </div>
                        </div>
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
               <div class="col-lg-4 row m-0 p-0">
                  <div class="col-md-4 col-lg-12">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <h6>Assets</h6>
                           <div class="text-center">
                              <h2>-108.56K</h2>
                              <p class="mb-0">Lorem ipsum dolor sit amet</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <h6>Liabilities</h6>
                           <div class="text-center">
                              <h2>-425.20K</h2>
                              <p class="mb-0">Lorem ipsum dolor sit amet</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                     <div class="card card-block card-stretch card-height rounded">
                        <div class="card-body">
                           <h6>Working Capital</h6>
                           <div class="text-center">
                              <h2>-380.40K</h2>
                              <p class="mb-0">Lorem ipsum dolor sit amet</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="top-block d-flex align-items-center justify-content-between">
                                 <h5>Revenue</h5>
                                 <span class="badge badge-primary">Monthly</span>
                              </div>
                              <h3>$<span class="counter">35000</span></h3>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <p class="mb-0">Total Revenue</p> <span class="text-primary">35%</span>
                              </div>
                              <div class="iq-progress-bar mt-3"> <span class="bg-primary" data-percent="55"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="top-block d-flex align-items-center justify-content-between mt-1">
                                 <h5>Orders</h5>
                                 <span class="badge badge-warning">Anual</span>
                              </div>
                              <h3><span class="counter">2500</span></h3>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                 <p class="mb-0">New Orders</p> <span class="text-warning">24%</span>
                              </div>
                              <div class="iq-progress-bar mt-3"> <span class="bg-warning" data-percent="45"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="top-block d-flex align-items-center justify-content-between mt-1">
                                 <h5>Leads</h5>
                                 <span class="badge badge-danger">Today</span>
                              </div>
                              <h3>$<span class="counter">55000</span></h3>
                              <div class="d-flex align-items-center justify-content-between">
                                 <p class="mb-0">New Leads</p> <span class="text-danger">50%</span>
                              </div>
                              <div class="iq-progress-bar mt-3"> <span class="bg-danger" data-percent="50"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card card-block card-stretch card-height">
                           <div class="card-body">
                              <div class="top-block d-flex align-items-center justify-content-between">
                                 <h5>Conversion Rate</h5>
                                 <span class="badge badge-info">This Month</span>
                              </div>
                              <h3><span class="counter">35</span>%</h3>
                              <div class="d-flex align-items-center justify-content-between">
                                 <p class="mb-0">This Month</p> <span class="text-info">5%</span>
                              </div>
                              <div class="iq-progress-bar mt-3"> <span class="bg-info" data-percent="25"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="card card-block card-stretch card-height iq-user-profile-block">
                     <div class="card-body">
                        <div class="user-details-block">
                           <div class="user-profile text-center">
                              <img src="../assets/images/user/11.png" alt="profile-img" class="avatar-60 rounded img-fluid">
                           </div>
                           <div class="text-center mt-3">
                              <h4><b>Bini Jets</b></h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in arcu turpis. Nunc</p> <a href="#" class="btn btn-primary">Assign</a>
                           </div>
                           <hr>
                           <ul class="d-flex align-items-center justify-content-between p-0 mb-0 list-inline">
                              <li class="text-center">
                                 <h3 class="counter">4500</h3>
                                 <span>Operations</span>
                              </li>
                              <li class="text-center">
                                 <h3 class="counter">3.9</h3>
                                 <span>Medical Rating</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div
@endsection