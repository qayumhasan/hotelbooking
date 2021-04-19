@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$current =date("d/m/Y");
$time = date("h:i");
@endphp
<style>
    .old_guest{
        cursor: pointer;
        border-bottom: 1px solid yellow;
    }
</style>


<script src="{{asset('public/backend')}}/assets/js/select2.js"></script>
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/css/select2.css">


<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Advance Booking</h4>
                        </div>
                        <a href="{{route('admin.advance.booking.report')}}"><button class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Advance Booking</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.advance.booking.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="header-title">
                                                <h4 class="card-title">Advance Booking Content</h4>
                                            </div>
                                        </div>

                                        <div class="col-md-6 text-right">
                                                <span>If returning guest? <a class="old_guest border-danger" id="showguestname" data-toggle="modal" data-target="#guestlist" data-whatever="@getbootstrap">Click to search</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @php
                                                $bookingid = rand(11111,999999);
                                                @endphp
                                                <label>Booking ID: {{$bookingid}}</label>
                                                <input type="hidden" value="{{$bookingid}}" name="booking_id" />
                                                <input type="hidden" value="{!!$currency->symbol ?? ' '!!}" id="symbol"/>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Booked Date:</label>
                                                <div class="col-sm-7">
                                                    <input type="text" value="{{$current}}" name="booked_date" required class="form-control datepicker form-control-sm" value="{{old('booked_date')}}">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">CheckIn Date:</label>
                                                <div class="col-sm-5">
                                                    <input type="text" required value="{{$current}}" name="checkindate" class="form-control datepicker form-control-sm" id="checkindate">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="time" required name="checkintime" class="form-control form-control-sm" value="{{$time}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">CheckOut Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" required value="{{$current}}" name="checkoutdate" class="form-control datepicker form-control-sm" id="checkoutdate">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="time" required name="checkouttime" class="form-control form-control-sm" value="{{$time}}">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Guest Name :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" required name="guest_name" id="select_guest_name">
                                                        <option disabled selected>---Select A Guest Name----</option>
                                                        @foreach($guests as $row)
                                                        <option value="{{$row->id}}">{{$row->guest_name}}</option>

                                                        @endforeach

                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <button type="button" data-toggle="modal" data-target="#addguest" class="btn btn-sm btn-primary "><i class="fas fa-plus m-0"></i></button>
                                                </div>
                                            </div>
                                        </div>




                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Room Type :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" required name="room_type" id="room_type">
                                                        <option selected disabled>---Select Room Type ------</option>
                                                        @foreach($roomtypes as $row)
                                                        <option value="{{$row->id}}">{{$row->room_type}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('room_type')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">No OF Rooms :</label>
                                                <div class="col-sm-6">
                                                    <input type="number" required class="form-control form-control-sm" name="no_of_room" value="{{old('no_of_room')}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group" id="room_section">
                                                <label for="exampleInputEmail1">Room Selection</label>
                                                <div class="row border p-4">
                                                    <div class="col-sm-6 border-right">

                                                        <div class="room_list mt-3" id="rooms">

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="selected_room">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>

                                                                        <th scope="col">Room</th>
                                                                        <th scope="col">Tariff</th>
                                                                        <th scope="col">Action</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="selectedroom">


                                                                </tbody>
                                                                <tbody>

                                                                    <tr>
                                                                        <td>Total:</td>
                                                                        <td id="totaltariff"></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Thru Agent :</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="thru_agent" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Booking Source :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="find_us">
                                                        <option value="auto/texi">Auto/Texi</option>
                                                        <option value="direct">Direct</option>
                                                        <option value="friends">Friends</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Remarks</label>
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">

                                                        <div class="room_list mt-3">
                                                            <textarea name="remarks" class="form-control form-control-sm"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Publish</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="is_active" id="customRadio-1" class="custom-control-input bg-primary" value="1" checked>
                                                <label class="custom-control-label" for="customRadio-1"> Active </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="is_active" id="customRadio-2" name="customRadio-10" class="custom-control-input bg-warning" value="0">
                                                <label class="custom-control-label" for="customRadio-2"> Deactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
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


<!-- Modal -->
<div class="modal fade" id="addguest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guest Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="add_guest_name" action="{{route('admin.guest.name.store')}}" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Guest Name:</label>
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm" name="title">
                                <option selected disabled>---- Select Title ------</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss">Miss</option>
                                <option value="M/s">M/S</option>
                                <option value="MS">MS</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Dr.">Dr.</option>
                            </select>
                            <span id="title" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="guest_name" id="guest_name_data">
                            <span id="guest_name" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Print Name:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" name="print_name" id="print_name_data">
                            <span id="print_name" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                        <label for="inputPassword" class="col-sm-1 col-form-label col-form-label-sm">Gender:</label>
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm" name="gender">
                                <option disabled selected>--- Select Gender ------</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <span id="gender" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Company Name:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="company_name">
                            <span id="company_name" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">City:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="city">
                            <span id="city" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Mobile:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="mobile">
                            <span id="mobile" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Email:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="email">
                            <span id="email" class="text-danger" style="font-size: 12px;"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="guestlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guest Name List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="guest_name_list">

            </div>
        </div>
    </div>
</div>



<script>
    var roomdata = [];

    var isdata = false;


    $(document).ready(function() {
        $('#guest_name_data').keypress(function(e) {
            console.log(e.target.value);
            $('#print_name_data').val(e.target.value);
        });
    });
    $(document).ready(function() {
        $('#room_section').hide();
    });
    var rooms = (function() {

        var roomtype = document.querySelector('#room_type');
        var roomsetup = document.querySelector('#rooms');





        var getRooms = [];

        var rooms = [];
        roomtype.addEventListener('change', function(event) {




            $('#room_section').show();
            var id = event.target.value;
            rooms = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/advance/booking/get/room') }}/" + id,

                success: function(data) {
                    rooms.push(data);
                    getRooms.push(data);


                    if (data.length > 0) {
                        var deletedrooms = document.querySelectorAll('.delete_rooms');
                        deletedrooms.forEach(function(e) {
                            e.remove();
                        })

                        data.forEach(function(item, index) {

                            var html = '<div class="form-check delete_rooms"><input class="form-check-input" onclick="selectedRoom(this)" type="checkbox" value="%value%" id="checkeditem%id%"><input type="hidden" value="%tarrif%"><label class="form-check-label" for="defaultCheck1">%room_no%( %room_type% )</label></div>';
                            var newhtml = html.replace('%room_no%', item.room_no);
                            var newhtml = newhtml.replace('%room_type%', item.roomtype.room_type);
                            var newhtml = newhtml.replace('%value%', item.id);
                            var newhtml = newhtml.replace('%tarrif%', item.tariff);
                            var newhtml = newhtml.replace('%id%', item.id);
                            roomsetup.insertAdjacentHTML('afterend', newhtml);
                        })



                        roomdata.forEach(function(item) {
                            var checkteditem = document.querySelector('#checkeditem' + item.id);
                            if (checkteditem) {
                                checkteditem.checked = true;
                                checkteditem.disabled = true;
                            }

                        });

                    }

                }
            });


        });

        return {
            getRooms: getRooms
        }

    })();


    var total = 0;




    function selectedRoom(el) {



        var room = [];
        if (el.checked == true) {
            
            rooms.getRooms.filter(function(element) {


                // return element.id == el.value;
                element.filter(function(ele) {
                    if (ele.id == el.value) {
                        room.push(ele);

                        var dublicatitem = roomdata.find(function(item) {
                            return ele.id === item.id;
                        })
                        if (!dublicatitem) {
                            // if not found
                            roomdata.push(ele);
                            
                        } else {
                            
                        }
                    }
                })

            });


            // var roomitem = [];
            // roomdata.forEach(function(items) {
            //     items.forEach(function(item) {
            //         roomitem.push(item);
            //     })
            // })

            // var dublicatitem = roomitem.find(function(item) {
            //     return room[0].id === item.id;
            // })



        } else if (el.checked == false) {

            var deletedroom = document.querySelector('#deletedelement' + el.value);
            deletedroom.remove();
            var tarriffnew = parseInt(el.nextElementSibling.value);
            total = total - tarriffnew;
            document.querySelector('#totaltariff').innerHTML = total;

            var deletedublicat = roomdata.filter(function(item) {
                return el.value != item.id;
            })

            roomdata = deletedublicat;

        }




        var room_id = room[0].id;

        var checkin = document.querySelector('#checkindate');
        var checkout = document.querySelector('#checkoutdate');

        if (checkin.value && checkout.value) {
            var checkindate = checkin.value;
            var checkoutdate = checkout.value;



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/advance/booking/check') }}/" + room_id,
                data: {
                    checkin: checkindate,
                    checkout: checkoutdate,
                },
                success: function(data) {

                    if (!data) {

                        
                            addRoom(room);
                        

                    } else {
                        var message = 'Sorry! This Room is Booked from %checkindate% to %checkoutdate%';

                        var newmassage = message.replace('%checkindate%', data.checkindate);
                        var newmassage = newmassage.replace('%checkoutdate%', data.checkoutdate);
                        iziToast.warning({
                            position: 'topCenter',
                            // message: 'Sorry! This Room is Booked with given Date and Time!',
                            message: newmassage,
                        });
                    }
                }
            });



        } else {
            checkin.focus();
            checkout.focus();

            iziToast.warning({
                position: 'topCenter',
                message: 'Sorry! You Need to select a check-in and check-out date!',
            });
        }




    }


 

    function addRoom(room) {

        var symbol = document.querySelector('#symbol').value;
        
        var roomelement = document.querySelector('#selectedroom');
        var html = '<tr class="deletedelement" id="deletedelement%deletedid%"><td>%room% (%room_type%)</td><td>%symbol% %tariff% <input type="hidden" class="counttotal" value="%price%"/></td><td><span class="text-center" onclick="deleteroom(this)"><i class="fa fa-trash" aria-hidden="true"></i><input type="hidden" class="deducttotal" value="%detuctprice%"/> <input type="hidden" name="room[]" value="%room_id%" </span></td></tr>';


        var newhtml = html.replace('%room%', room[0].room_no);
        var newhtml = newhtml.replace('%room_type%', room[0].roomtype.room_type);
        var newhtml = newhtml.replace('%deletedid%', room[0].id);
        var newhtml = newhtml.replace('%tariff%', room[0].tariff);
        var newhtml = newhtml.replace('%price%', room[0].tariff);
        var newhtml = newhtml.replace('%detuctprice%', room[0].tariff);
        var newhtml = newhtml.replace('%room_id%', room[0].id);
        var newhtml = newhtml.replace('%symbol%', symbol);
        roomelement.insertAdjacentHTML('afterend', newhtml);


        var count = document.querySelectorAll('.counttotal');
        var tarriff = parseInt(count[0].attributes[2].value);
        total = total + tarriff;
        document.querySelector('#totaltariff').innerHTML =symbol+' '+ total;


    }

    function deleteroom(el) {

        var room_id = el.children[2].value;

        var checkteditem = document.querySelector('#checkeditem' +  room_id);
                            if (checkteditem) {
                                checkteditem.checked = false;
                                checkteditem.disabled = false;
                            }
        var deletedublicat = roomdata.filter(function(item) {
                return room_id != item.id;
            })

            roomdata = deletedublicat;
        

        var deducttariff = parseInt(el.children[1].value);
        total = total - deducttariff;
        el.closest('.deletedelement').remove();
        document.querySelector('#totaltariff').innerHTML = total;

    }
</script>

<script>
    $(document).ready(function() {

        $(document).on('submit', '#add_guest_name', function(e) {
            e.preventDefault();
            
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {

                   
                

                    $('#addguest').modal('hide');

                    $('#select_guest_name').empty();
                    $('#select_guest_name').append(' <option value="0">--Please Guest Name--</option>');
                    $.each(data.guests, function(index, divisionobj) {

                        $('#select_guest_name').append('<option value="' + divisionobj.id + '">' + divisionobj.guest_name + '</option>');
                    });

                    $('#select_guest_name').val(data.id).selected;

                    

                    // toastr.success('Guest Insert Succssfully!');

                    //log(data);

                    //     $('.loading_button').hide();
                    //     $('.submit_button').show();
                    //     $('.error').html('');
                    //     $('#add_income_form')[0].reset();
                    //     $('#myModal1').modal('hide');
                    //      setInterval(function() {
                    //     window.location = "{{ url()->current() }}";
                    // }, 700);

                },
                error: function(err) {


                    if (err.responseJSON.errors.title) {
                        $('#title').html(err.responseJSON.errors.title[0])
                    }
                    if (err.responseJSON.errors.guest_name) {
                        $('#guest_name').html(err.responseJSON.errors.guest_name[0])
                    }
                    if (err.responseJSON.errors.print_name) {
                        $('#print_name').html(err.responseJSON.errors.print_name[0])
                    }

                    if (err.responseJSON.errors.gender) {
                        $('#gender').html(err.responseJSON.errors.gender[0])
                    }
                    if (err.responseJSON.errors.city) {
                        $('#city').html(err.responseJSON.errors.city[0])
                    }
                    if (err.responseJSON.errors.mobile) {
                        $('#mobile').html(err.responseJSON.errors.mobile[0])
                    }
                    //log(err.responseJSON.errors);
                    // if (err.responseJSON.errors.header_id) {
                    //     $('.header_error').html('Income header is required');

                    //     $('.header').addClass('is-invalid');
                    // } else {
                    //     $('.header_error').html('');
                    //     $('.header').removeClass('is-invalid');
                    // }

                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#showguestname').click(function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: 'get',
                url: "{{route('admin.guest.name.list')}}",

                success: function(data) {
                    $('#guest_name_list').empty();
                    $('#guest_name_list').append(data);
                }
            });
        });
    });




    function getuserData(e) {
        var modal = $(e)
        var data = modal.data('whatever');

        $('#select_guest_name').val(data.id).selected;
        // $('#old_guest_data').prop('checked', true);
        $('#guestlist').modal('hide');


    }
</script>

<!-- <script>
    $("#select_guest_name").select2({
        placeholder: '----Select Name----'
    });
</script> -->



@endsection