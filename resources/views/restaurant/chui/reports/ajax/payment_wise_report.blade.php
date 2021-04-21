

            @if(count($paymentwise) > 0)
            @foreach($paymentwise as $key=>$row)
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
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
                    <div class="card-body">
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