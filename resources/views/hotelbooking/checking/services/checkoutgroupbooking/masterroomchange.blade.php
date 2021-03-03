@extends('hotelbooking.master')
@section('title', 'Single Check out In-GroupBookig | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$time = date("h:i A");
@endphp


<style>
    #delectimage {
        position: absolute;
        top: 0;
        right: 2%;
    }

    .form-group {
        margin-bottom: 5%;
    }

    html {
        scroll-behavior: smooth;
    }


    .controll-from {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 3px;
        font-size: 10px;

    }

    .control-label {
        font-size: 12px;
    }

    input:required:focus {
        border: 1px solid red;
        outline: none;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Master Room Change</h4>
                        </div>


                    </div>
                </div>

                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Details</h4>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="row">

                                        <table class="table table-borderless">
                                            <tbody>

                                                <tr>
                                                    <th class="control-label" scope="row">Booking No</th>
                                                    <td class="control-label">- {{$checkin->booking_no}}</td>

                                                    <th class="control-label" scope="row">Booking Date</th>
                                                    <td class="control-label">{{$checkin->created_at}}</td>

                                                </tr>

                                                <tr>
                                                    <th class="control-label" scope="row">Room Type</th>
                                                    <td class="control-label">{{$checkin->roomtype->room_type ?? ''}}</td>

                                                    <th class="control-label" scope="row">Room No</th>
                                                    <td class="control-label">{{$checkin->room_no}}</td>


                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Change Master Room</h4>
                                    </div>
                                </div>


                                <form action="{{url('admin/change/masterroom/groupbooking/submit')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Master Rooom:</label>
                                               
            
                                           
                                                <div class="col-sm-3">
                                                    <p>{{ $masterroom->room_no}} ({{ $masterroom->roomtype->room_type }})</p>
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Select Room:</label>
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="booking_no" value="{{ $checkin->booking_no }}">
                                                    <input type="hidden" name="id" value="{{ $checkin->id }}">
                                                    <input type="hidden" name="old_room" value="{{ $masterroom->room_id }}">
                                                    <select name="room_id"  class="form-control form-control-sm">
                                                        @php
                                                          $allroom=App\Models\Room::where('room_status',1)->where('is_active',1)->get();
                                                        @endphp
                                                        <option value="">--Select--</option>
                                                        @foreach($allroom as $room)
                                                        <option value="{{$room->id}}">{{ $room->room_no }}({{ $room->roomtype->room_type }} - {{ $room->tariff}})</option>
                                                        @endforeach
                                                 
                                                    </select>
                                                    @error('room_id')
                                                        <div style="color:red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Tarrif:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="tarrif" id="tarrif" class="form-control form-control-sm" value="">
                                                </div>
                                             
                                            </div>
                                        </div>
                                     
                                    <div class="col-md-12">

                                    
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" text-center">
                                            <span id="start-one">
                                                <button id="file-upload-btn" type="submit" class="btn btn-lg btn-primary">Submit</button>
                                            </span>

                                        </div>
                                    </div>

                                    </div>
                                  
                                    </div>

                                   
                                </div>
                                </form>

                            </div>

                        </div>
                    </div>



            </div>


        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="room_id"]').on('change', function(){
        var room_id=$(this).val();
        


         if(room_id) {
             $.ajax({
                 url: "{{  url('/get/addroom/tariff') }}/"+room_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                     //console.log(data);
                        $('#tarrif').val(data.tariff);
                      

                    }
             });
         } else {
             //alert('danger');
         }

     });
 });
</script>

@endsection