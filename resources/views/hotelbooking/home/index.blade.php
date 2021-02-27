@extends('hotelbooking.master')
@section('content')
<style>
   .mouse_pointer {
      cursor: pointer;
   }

   .card-item {
      transform-style: preserve-3d;
      border-radius: 5px;
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.2), 0px 0px 50px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
   }

   .status-heading {
      font-size: 24px;
      font-weight: bold;
      color: black;
   }

   .list-group-item {
      font-size: 12px;
      padding: 8px 0 0 10px;

   }

   .list-group {
      border-radius: 0px;
   }

   .service {
      padding-top: 8px;
   }

   .service ul li {
      list-style-type: none;
      font-size: 12px;
      padding: 3px 0;
   }


   .bg-navyblue {
      background-color: #66CCFF;
      color: #ffffff;
   }

   .bg-yellow {
      background: #FFFF66;
   }

   .bg-green {
      background-color: #99CC00;
   }

   .bg-menu {
      background: #E7E9E6;
      color: #1D627E;
      font-weight: bold;
   }

   .text-color-service {
      color: #1D627E;
      font-weight: bold;
   }
</style>
<div class="content-page">
   @foreach($rooms as $row)
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{$row->room_type}}</h4>
                  </div>
                  <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm bg-primary"><span class="pl-1">USD {{$row->price}}</span>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach($row->rooms as $row)
         <div class="col-md-6 col-lg-4">
            <div class="cardoverflow-hidden card-min-height">


               <div class="card-item">
                  <div class="status text-center 
                  @if($row->room_status == 1)
                  bg-green
                  @elseif($row->room_status == 2)
                  bg-navyblue
                  @elseif($row->room_status == 3)
                  bg-red
                  @elseif($row->room_status == 4)
                  bg-yellow
                  @endif
                  ">
                     <span class="status-heading">{{$row->room_no}}</span>

                  </div>


                  <!-- room status Available area start -->
                  @if($row->room_status == 1)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">Available</li>
                              <li> {{$row->tariff}}</li>
                              <li>{{$row->flortype->name ?? ' '}}</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">
                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-history" aria-hidden="true"></i> At a Glance</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href="{{route('admin.checking.index',$row->id)}}"><i class="fa fa-globe" aria-hidden="true"></i> Check In</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-calendar-check" aria-hidden="true"></i> History
                              </a>
                           </li>

                        </ul>
                     </div>
                  </div>
                  @endif
                  <!-- room status Available area end -->

                  <!-- room status House-Keeping area start -->
                  @if($row->room_status == 2)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">House Kepping</li>
                              <li>Cleaning</li>
                              <li>{{$row->flortype->name ?? ' '}}</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">
                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-history" aria-hidden="true"></i> At a Glance</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-globe" aria-hidden="true"></i> House Keeping</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-calendar-check" aria-hidden="true"></i> History
                              </a>
                           </li>

                        </ul>
                     </div>
                  </div>
                  @endif
                  <!-- room status House-Keeping area end -->

                  <!-- room status Booking area start -->
                  @if($row->room_status == 3)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">{{$row->checkin['guestname'] ?? ''}}</li>
                              <li>{{$row->checkin['mobile'] ?? ''}}</li>
                              <li>{{$row->checkin['company_name'] ?? ''}}</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">
                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu mouse_pointer" data-toggle="modal" data-target=".ataglance" data-whatever="@mdo" href="{{route('admin.chickin.at.glance',$row->id)}}"><i class="fa fa-history" aria-hidden="true"></i> At a Glance</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href="{{route('admin.checkin.edit',$row->checkin['id'] ?? '')}}"><i class="fa fa-globe" aria-hidden="true"></i> Services</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a href="{{route('admin.booking.checkout',$row->id)}}" class="bg-menu" href=""><i class="fa fa-calendar-check" aria-hidden="true"></i>
                                 Check Out
                              </a>
                           </li>

                        </ul>
                     </div>
                  </div>
                  @endif
                  <!-- room status Booking area end -->

                  <!-- room status Maintenance: area start -->
                  @if($row->room_status == 4)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">Maintenance</li>
                              <li>Un-Use</li>
                              <li>{{$row->flortype->name ?? ' '}}r</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">
                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-history" aria-hidden="true"></i> At a Glance</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-globe" aria-hidden="true"></i> House Keeping</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu" href=""><i class="fa fa-calendar-check" aria-hidden="true"></i> History
                              </a>
                           </li>

                        </ul>
                     </div>
                  </div>
                  @endif
                  <!-- room status Maintenance: area end -->


               </div>

            </div>
         </div>
         @endforeach















      </div>
   </div>
   @endforeach


</div>


<div class="modal fade ataglance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">At A Glance Of Table No : 500</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-md-5">
                     <input type="text" class="form-control form-control-sm" placeholder="First name">
                  </div>
                  <div class="col-md-5">
                     <input type="text" class="form-control form-control-sm" placeholder="Last name">
                  </div>
                  <div class="col-md-2">
                     <button type="submit" class="btn btn-sm btn-primary mr-auto">Search</button>
                  </div>
               </div>
            </form>

            <table class="table table-bordered mt-5">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">First</th>
                     <th scope="col">Last</th>
                     <th scope="col">Handle</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Mark</td>
                     <td>Otto</td>
                     <td>@mdo</td>
                  </tr>
                  <tr>
                     <th scope="row">2</th>
                     <td>Jacob</td>
                     <td>Thornton</td>
                     <td>@fat</td>
                  </tr>
                  <tr>
                     <th scope="row">3</th>
                     <td colspan="2">Larry the Bird</td>
                     <td>@twitter</td>
                  </tr>
               </tbody>
            </table>


         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('.mouse_pointer').click(function(e) {
         e.preventDefault();
         var url = e.currentTarget.href;

         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
               console.log(data);
            }
         });


      });
   });
</script>

@endsection