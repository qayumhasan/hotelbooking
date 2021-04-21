@extends('restaurant.chui.master')
@section('title', 'Customar Credit Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:30px;
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
@endphp
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Customar Credit Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">

                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table  class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Customar Name</th>
                                 <th>Billing Date</th>
                                 <th>Pay Amount</th>
                                 <th>Due Amount</th>
                                 <th>Balance</th>
                                 <th>Action</th>
                               
                              </tr>
                           </thead>
                           <tbody class="text-center">
                                @foreach($creditCustomars as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                       <td>{{$row->payment_details}}</td>
                                       <td>{{$row->customar_credit_date}}</td>
                                       <td>{{$row->pay_amount}}</td>
                                       <td>{{$row->gross_amount}}</td>
                                       <td>{{$row->gross_amount - $row->pay_amount}}</td>
                                        <td><a class="badge bg-success-light mr-2" href="{{route('admin.restaurant.credit.customar.voucher',$row->id)}}"><i class="lar la-edit"></i></a></td>
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