@extends('hotelbooking.master')
@section('title', 'All Room | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Room</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="#" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Booking No</th>
                                 <th>Room</th>
                                 <th>Guest</th>
                                 <th>Mobile</th>
                                 <th>In Date</th>
                                 <th>Exp.Out Date</th>
                                 <th>Tariff</th>
                                 <th>Checkin By</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                           @foreach($checkins as $row)
                             <tr>
                                <td>{{$row->booking_no}}</td>
                                <td>{{$row->room_no}}</td>
                                <td>{{$row->guestname}}</td>
                                <td>{{$row->mobile}}</td>
                                <td>{{$row->checkin_date}}</td>
                                <td>{{$row->exp_checkin_date}}</td>
                                <td>{{$row->tarif}}</td>
                                <td>{{$row->user->username}}</td>
                             </tr>
                            @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
@endsection