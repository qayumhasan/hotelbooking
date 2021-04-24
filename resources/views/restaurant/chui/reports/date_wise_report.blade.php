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

                    <form id="searchdatewisereport" action="{{route('admin.date.wise.ajax.list')}}" method="post">
                    @csrf
                        <div class="card-body text-center">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label text-right">From Date :</label>
                                <div class="col-sm-3">
                                    <input type="text" value="{{$current}}" class="form-control text-center form-control-sm datepicker searhbydate" name="from_date" id="searhbydate">
                                    <small class="from_date text-danger"></small>
                                </div>

                                <label for="staticEmail" class="col-sm-2 col-form-label text-right">To Date :</label>
                                <div class="col-sm-3">
                                    <input type="text" value="{{$current}}" class="form-control text-center form-control-sm datepicker searhbydate" name="to_date" id="searhbydate">
                                    <small class="to_date text-danger"></small>
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

            @if(count($datewise) > 0)
            @foreach($datewise as $key=>$row)
            <div class="col-sm-12">
                <div class="card m-0 border-bottom">
                    <div class="card-header d-flex justify-content-between p-1">
                        <div class="header-title">
                            <h4 class="card-title">{{$key}}</h4>
                        </div>
                        <span class="float-right mr-2">

                        </span>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered m-0">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice No</th>
                                        <th>Booking No</th>
                                        <th>Waiter Name</th>
                                        <th>Item Name</th>
                                        <th>Qty</th>
                                        <th>Total Price</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                    $totalqty = 0;
                                    $totalamount = 0;
                                    @endphp
                                    @foreach($row as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->invoice_id}}</td>
                                        <td>{{$data->booking_no}}</td>
                                        <td>{{$data->waiter->employee_name ?? ' '}}</td>
                                        <td>{{$data->item->item_name ?? ' '}}</td>
                                        <td>{{$data->qty}}</td>
                                        <td>{{$data->amount}}</td>
                                        @php
                                        $totalqty = $totalqty + $data->qty;
                                        $totalamount = $totalamount + $data->amount;
                                        @endphp
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="5">Total:</th>
                                        <th>{{$totalqty}}</th>
                                        <th> {!!$currency->symbol ?? ' '!!} {{$totalamount}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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






<!-- <script>
    function searhbydate(e) {
        var date = e.value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ route('admin.date.wise.ajax.list') }}",
            data: {
                date
            },
            success: function(data) {
               

            }
        });
    }
</script> -->

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