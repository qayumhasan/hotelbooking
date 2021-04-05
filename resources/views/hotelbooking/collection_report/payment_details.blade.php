@extends('hotelbooking.master')
@section('title', 'Payment Details | '.$seo->meta_title)
@section('content')


<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">

             
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Guest:</b></label>
                            <div class="col-sm-5">
                                
                                <small class="text-danger from_date"></small>
                            </div>

                            <!-- <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button> -->

                        </div>


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Payment Details (Cash/Bank)</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive guest_ajax_data">


                            <table class="table table-bordered">
                                <thead>

                                    <tr>
                                        <th scope="col">Room No.</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Bill No.</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Cash</th>
                                        <th scope="col">Bank</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>




                        </div>

                        <!-- preloader area start -->
                        <section id="preloader">
                            <div class="preloader">
                                <!-- <div></div>
                                <div></div>
                                <div></div> -->
                                <h3 class="text-center">Loading</h3>
                            </div>

                        </section>
                        <!-- preloader area end -->



                    </div>
                </div>
            </div>
        </div>


        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>


<script>
    $("#select_room_no").select2({
        placeholder: '----Select Room No----'
    });
</script>


<script>
    $(document).ready(function(){
        $('#guest_name').change(function(e){
            $('.guest_ajax_data').empty();
                var guestID = e.currentTarget.value;
                $.ajax({
                type: 'GET',
                url: "{{ route('admin.guest.payment.history.ajax') }}",
                data: {
                    guestid:guestID,
                },
                success: function(data) {

                    $('.preloader').hide();
                    $('.guest_ajax_data').append(data);
                    console.log(data);

                }

            });
        })
    });
</script>



@endsection