@extends('restaurant.chui.master')
@section('title', 'Customar Credit Report | '.$seo->meta_title)
@section('content')
<style>
    .form-control {
        height: 30px;
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
                    <form id="searchdatewisereport" action="{{route('admin.payment.method.wise.ajax.list')}}" method="post">
                        @csrf
                        <div class="card-body text-center">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-1 col-form-label text-right">From Date :</label>
                                <div class="col-sm-2">
                                    <input type="text" value="{{$current}}" class="form-control text-center form-control-sm datepicker searhbydate" name="from_date" id="searhbydate">
                                    <small class="from_date text-danger"></small>
                                </div>

                                <label for="staticEmail" class="col-sm-1 col-form-label text-right">To Date :</label>
                                <div class="col-sm-2">
                                    <input type="text" value="{{$current}}" class="form-control text-center form-control-sm datepicker searhbydate" name="to_date" id="searhbydate">
                                    <small class="to_date text-danger"></small>
                                </div>

                                <label for="staticEmail" class="col-sm-2 col-form-label text-right">Payment Method</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" onchange="searhbypayment(this)" name="payment_method" required="" name="payment_mode" id="payment_mode">
                                        <option disabled="" selected="">---Select Payment Mode----</option>
                                        <option value="1">Cash</option>
                                        <option value="2">Card</option>
                                        <option value="4">Credit</option>
                                        <option value="5">Post To Room</option>
                                    </select>
                                </div>

                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row printableAreasaveprint" id="datewiseitem">


            @if(count($paymentwise) > 0)
            @foreach($paymentwise as $key=>$row)
            <div class="col-sm-12">
                <div class="card m-0">
                    <div class="card-header p-1 d-flex justify-content-between">
                        <div class="header-title">
                            @if($key == 1)
                            <h4 class="card-title">Cash</h4>
                            @elseif($key==2)
                            <h4 class="card-title">Card</h4>
                            @elseif($key == 4)
                            <h4 class="card-title">Credit</h4>
                            @elseif($key == 5)
                            <h4 class="card-title">Post To Room</h4>
                            @endif
                        </div>
                        <span class="float-right mr-2">

                        </span>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice No</th>
                                        <th>Booking No</th>
                                        <th>Waiter Name</th>
                                        <th>Number Of Item</th>
                                        <th>Number Of Qty</th>
                                        <th>Total Price</th>

                                    </tr>
                                </thead>
                                @php
                                $totalitem = 0;
                                $totalqty = 0;
                                $totalamount = 0;
                                @endphp
                                <tbody>
                                    @foreach($row as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-center">{{$data->invoice_no}}</td>
                                        <td class="text-center">{{$data->orderDetail->booking_no ?? ' '}}</td>
                                        <td class="text-center">{{$data->orderDetail->waiter->employee_name ?? ' '}}</td>
                                        <td class="text-center">{{$data->number_of_item}}</td>
                                        <td class="text-center">{{$data->number_of_qty}}</td>
                                        <td class="text-center">{{$data->gross_amount}}</td>
                                        @php
                                        $totalitem = $totalitem + $data->number_of_item;
                                        $totalqty = $totalqty + $data->number_of_qty;
                                        $totalamount =$totalamount+$data->gross_amount;
                                        @endphp
                                    </tr>
                                    @endforeach
                                    <tr class="text-center">
                                        <th colspan="4" class="text-right">Total: </th>
                                        <th>{{$totalitem}}</th>
                                        <th>{{$totalqty}}</th>
                                        <th>{{$totalamount}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>No Data Found!</h5>
                    </div>

                </div>
            </div>

            @endif


        </div>

        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary text-center mx-auto savepritbtn">Print</button>
            </div>
        </div>



    </div>

</div>


</div>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#searchdatewisereport', function(e) {
            e.preventDefault();
       
       
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {
                    $('#datewiseitem').empty();
                    $('#datewiseitem').append(data);
                    

                },
                error: function(err) {
                   
                    if (err.responseJSON.errors.from_date) {
                        $('.from_date').html('Income header is required');
                    }

                    if (err.responseJSON.errors.to_date) {
                        $('.to_date').html('Income header is required');
                    }
                }
            });
        });
    });
</script>
@endsection



<script>
    $(function() {
        $(".savepritbtn").on('click', function() {

            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprint").printArea(options);
        });
    });
</script>