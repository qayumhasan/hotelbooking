@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
@endphp

@if(count($datewise) > 0)
            @foreach($datewise as $key=>$row)
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{$key}}</h4>
                        </div>
                        <span class="float-right mr-2">

                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
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
                                        <th>  {!!$currency->symbol ?? ' '!!} {{$totalamount}}</th>
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
                        <h5 class="text-center">No Data Found!</h5>
                    </div>
                    
                </div>
            </div>

            @endif
     