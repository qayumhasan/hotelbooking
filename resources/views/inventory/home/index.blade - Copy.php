@extends('hotelbooking.master')
@section('content')
<style>
   .card-item {
      transform-style: preserve-3d;
      border-radius: 30px;
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.2), 0px 0px 50px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
   }

   .sneaker {
      min-height: 10vh;
      display: flex;
      align-items: center;
      justify-content: center;
   }


   .circle {
      position: absolute;
      width: 20%;
      height: 33%;
      /* background: linear-gradient(to right,
            rgba(247, 70, 66, 0.75),
            rgba(8, 83, 156, 0.75)); */
         
            /* background: #66CCFF; */
      border-radius: 50%;
      z-index: 1;
      transition: .5s;
   }

   .room-no {
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

   .status {
      border-radius: 30px 30px 0 0;
      padding: 7px 0px;
   }

   .overlay_manu {
      background: rgba(89, 201, 188, .5);
      position: absolute;
      width: 100%;
      height: 78%;
      padding: 20px;
      top: calc(100% - 0%);
      left: 0;
      overflow: none;
      text-align: center;
      /* background: rgba(89, 201, 188, .7); */
      transition: .5s;
      border-radius: 0px 0px 30px 30px;
      
   }

   .menu_area {
      
      

   }

   .menu_area ul li {
      text-decoration: none;
      list-style-type: none;
      padding-right: 20%;
      
      
   }
   .menu_area ul li a{
      color: white;
      border-bottom: 1px solid whitesmoke;
      padding:2px;
      display: inline-block;
      
   }
   .card-item:hover .overlay_manu{
      top: 22%;
      
   }
   
   .card-item:hover .sneaker{
      opacity: .5;
   }
   .card-item:hover .circle{
      opacity: .5;
      
   }
   .card-item:hover .room-no{
      opacity: .5;
   }
   .card-item:hover .sizes{
      opacity: .1;
   }
   .bg-navyblue{
      background-color: #66CCFF;
      color: #ffffff;
   }
   .bg-yellow{
      background: #FFFF66;
   }
   .bg-green{
      background-color: #99CC00;
   }
   .bg-navyblue-hover{
      background:rgba(102, 204, 255, .7);
   }
   
   .bg-red-hover{
      background:rgba(204, 30, 30, .7)
   }
   .bg-yellow-hover{
      background: rgba(229, 230, 0, .7);
      
   }
   .bg-green-hover{
      background: rgba(67, 211, 150, .7);
      
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
            <div class="cardoverflow-hidden card-min-height">
 

               <div class="card-item">
                  <div class="status text-center bg-navyblue">
                     <span class="status-heading">House-Keeping</span>
                     
                  </div>
                  <div class="sneaker">
                     <div class="circle bg-navyblue"></div>
                     <h4 class="room-no">103</h4>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">

                        <h6 class="">Cleaning</h6>
                        <h6 class="">First Floor</h6>
                     </div>

                  </div>
                  <div class="overlay_manu text-center bg-navyblue-hover">
                     <div class="menu_area">
                        <ul>
                           <li><a href="">At a Glance</a></li>
                           <li><a href="">House Kepping</a></li>
                           <li><a href="">History</a></li>
                        </ul>
                     </div>
                  </div>

               </div>

            </div>
         </div>

         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height">
   

               <div class="card-item">
                  <div class="status text-center bg-red">
                     <span class="status-heading">Qayum Hasan</span>
                     
                  </div>
                  <div class="sneaker">
                     <div class="circle bg-red"></div>
                     <h4 class="room-no">301</h4>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">

                        <h6 class="">01559505992</h6>
                        <h6 class="">Durbar Group</h6>
                     </div>

                  </div>
                  <div class="overlay_manu text-center bg-red-hover">
                     <div class="menu_area">
                        <ul>
                           <li><a href="">At a Glance</a></li>
                           <li><a href="">Services</a></li>
                           <li><a href="">Checkout</a></li>
                        </ul>
                     </div>
                  </div>

               </div>

            </div>
         </div>

         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height">
           

               <div class="card-item">
                  <div class="status text-center bg-green">
                     <span class="status-heading">Available</span>
                     
                  </div>
                  <div class="sneaker">
                     <div class="circle bg-green"></div>
                     <h4 class="room-no">301</h4>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">

                        <h6 class="">$100.00</h6>
                        <h6 class="">Second Floor</h6>
                     </div>

                  </div>
                  <div class="overlay_manu text-center bg-green-hover">
                     <div class="menu_area">
                        <ul>
                           <li><a href="">At a Glance</a></li>
                           <li><a href="">Check In</a></li>
                           <li><a href="">History</a></li>
                        </ul>
                     </div>
                  </div>

               </div>

            </div>
         </div>

         <div class="col-md-6 col-lg-3">
            <div class="cardoverflow-hidden card-min-height">
              

               <div class="card-item">
                  <div class="status text-center bg-yellow">
                     <span class="status-heading">Maintenance</span>
                     
                  </div>
                  <div class="sneaker">
                     <div class="circle bg-yellow"></div>
                     <h4 class="room-no">301</h4>
                  </div>
                  <div class="info">
                     <!-- <h1 class="title">Adidas ZX</h1> -->
                     <div class="sizes">

                        <h6 class="">Un-Use</h6>
                        <h6 class="">Second Floor</h6>
                     </div>

                  </div>
                  <div class="overlay_manu text-center bg-yellow-hover">
                     <div class="menu_area">
                        <ul>
                           <li><a href="">At a Glance</a></li>
                           <li><a href="">House Kepping</a></li>
                           <li><a href="">History</a></li>
                        </ul>
                     </div>
                  </div>

               </div>

            </div>
         </div>







        


      </div>
   </div>
</div>

@endsection