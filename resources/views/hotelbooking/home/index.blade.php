@extends('hotelbooking.master')
@section('content')
<style>
   .card-item {
      transform-style: preserve-3d;
      border-radius: 30px;
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.2), 0px 0px 50px rgba(0, 0, 0, 0.2);
   }

   .sneaker {
      min-height: 10vh;
      display: flex;
      align-items: center;
      justify-content: center;
   }


   .circle {
      position: absolute;
      width: 26%;
      height: 35%;
      background: linear-gradient(to right,
            rgba(247, 70, 66, 0.75),
            rgba(8, 83, 156, 0.75));
      border-radius: 50%;
      z-index: 1;
   }

   .room-no{
      color: white;
      z-index: 9999;
   }

  

   .sizes {
      display: flex;
      /* padding-bottom: 8%; */
      padding: 0 5% 8% 5%;
      justify-content: space-between;
      transition: all 0.75s ease-out;
   }
   .status{
      border-radius: 30px 30px 0 0;
   }


</style>
<div class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">DELUXE ROOMS</h4>
                  </div>
                  <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm bg-primary"><span class="pl-1">KSH 13000.00</span>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height" style="position: relative;">
               <!-- <div class="card-body pb-0">
                        <div class="text-center">
                           <h2 class="mb-0 room-number"><span>103</span></h2>
                           <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i>House-Keeping</p>
                        </div>
                     </div> -->

               <div class="card-item">
                  <div class="status text-center bg-primary">
                     <span class="status-heading">House-Keeping</span>
                     <hr>
                  </div>
                  <div class="sneaker">
                     <div class="circle"></div>
                     <h2 class="room-no">301</h2>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">
                        
                        <h5 class="text-orange">$100.00</h5>
                        <h5 class="text-primary">Second Floor</h5>
                     </div>
                     
                  </div>
                  
               </div>

            </div>
         </div>
     
         
      </div>
   </div>
</div>

@endsection