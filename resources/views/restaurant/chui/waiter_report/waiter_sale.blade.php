@extends('restaurant.chui.master')
@section('title', 'Sales Report | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d - F - Y");
$time = date("h:i");
@endphp



<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">

                    <form id="search_kot_items" action="{{route('admin.restaurant.chui.menu.Kot.waiter.sale.serarch')}}" method="post">
                        <div class="form-group row mx-auto">
                        @php
                        $firstYear = (int)date('Y')-20;
                        $lastYear = $firstYear + 20;

                        @endphp
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Month:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" id="select_item" name="month">
                                    <option selected disabled>---Select A Month -----</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July </option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                        
                                    
                                </select>
                                <small id="month_no" class="text-danger"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Year:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm select_item" id="exampleFormControlSelect1" name="year">
                                    <option selected disabled>---Select A Year -----</option>

                                    @for($i=$firstYear;$i<=$lastYear;$i++)
                                            <option {{(int)date('Y') == $i ?'selected':''}}  value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    
                                </select>
                                <small id="year" class="text-danger"></small>
                            </div>



                            <div class="col-sm-2">
                                <button type="Submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Sales Report Of  ( {{$date}} )</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive fast_moving_item">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Waiter</th>
                                        <th scope="col">Item Qty</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>


                                @php
                                    $totalitems = 0;
                                    $totalamount = 0;

                                @endphp
                                @if(count($sales) > 0)
                                @foreach($sales as $row)
                                    <tr>
                                        <td>{{$row->waiter->employee_name?? ''}}</td>
                                        <td>{{$row->countitems}}</td>
                                        <td>{!!$currency->symbol ?? ' '!!} {{$row->slae_amount}}</td>
                                        
                                    </tr>
                                    @php
                                        $totalitems = $totalitems + $row->countitems;
                                        $totalamount = $totalamount + $row->slae_amount;
                                    @endphp
                                @endforeach
                                <tr>
                                    <th class="text-right">Total</th>
                                    <th>{{$totalitems}}</th>
                                    <th>{!!$currency->symbol ?? ' '!!} {{$totalamount}}</th>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="2">No Item Found!</td>
                                </tr>
                                   
                                   
                                @endif

                                </tbody>
                            </table>



                        </div>

                    </div>
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
        $(document).on('submit', '#search_kot_items', function(e) {
            e.preventDefault();
            $('.fast_moving_item').empty();
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {
                    console.log(data);
                    $('.fast_moving_item').append(data);

                },
                error: function(err) {
                    if (err.responseJSON.errors.month_no) {
                        $('#month_no').html(err.responseJSON.errors.month_no[0])
                    }
                    if (err.responseJSON.errors.year) {
                        $('#year').html(err.responseJSON.errors.year[0])
                    }
                }
            });
        });
    });
</script>




@endsection