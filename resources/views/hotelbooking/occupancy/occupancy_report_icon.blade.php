@extends('hotelbooking.master')
@section('title', 'Occupancy Report | '.$seo->meta_title)
@section('content')


<style>
    .room_items {
        width: 100%;
        height: 100%;
        padding: 15%;
    }

    .room_icon {
        font-size: 500%;
        border-radius: 50%;
        padding: 10% 15%;
    }
</style>

<div class="content-page">
    <div class="container-fluid printableAreasaveprint">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row text-center p-4">

                            @foreach($rooms as $row)
                            <div class="col-md-2 m-4 border border-light">
                                <div class="room_items">
                                    <h6 class="mx-auto pb-4"><b>Room {{$row->room_no}}</b></h6>



                                    <!-- room status vacent area start -->
                                    @if($row->room_status == 1)
                                    <div class="room_icon bg-gradient-primary text-white d-inline">

                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                    </div>
                                    <small class="mt-4 d-block">Vacent</small>
                                    <!-- room status vacent area end -->


                                    <!-- room status Housekeeping area Start -->

                                    @elseif($row->room_status == 2)
                                    <div class="room_icon bg-gradient-light text-white d-inline">
                                        <i class="fa fa-bath"></i>

                                    </div>
                                    <small class="mt-4 d-block">HouseKeeping</small>

                                    <!-- room status Housekeeping area end -->


                                    <!-- room status occupancy area start -->
                                    @elseif($row->room_status == 3)
                                    <div class="room_icon bg-gradient-danger text-white d-inline">

                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                    </div>
                                    <small class="mt-4 d-block">Occupied</small>
                                     <!-- room status occupancy area EDN -->
                                    @elseif($row->room_status == 4)

                                     <!-- room status Mantenancy area start -->


                                    <div class="room_icon bg-gradient-warning text-white d-inline">

                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                    </div>
                                    <small class="mt-4 d-block">Maintenance</small>
                                    <!-- room status Mantenancy area end -->

                                   
                                    @endif




                                </div>
                            </div>
                            @endforeach





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection