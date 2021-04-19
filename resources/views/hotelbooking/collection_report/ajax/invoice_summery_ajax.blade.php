<div class="col-sm-12 printableAreasaveprint">
           
                <div class="card">







@if(count($invoicesummarys) > 0)
    @foreach($invoicesummarys as $row)

                    <div class="card-body ">
                        <div class="table-responsive guest_ajax_data">


                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Outstanding</th>
                                        <th scope="col">Tax Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>{{$row->guest_name}}</td>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->invoice_date}}</td>
                                        <td>{{round($row->outstanding_amount,2)}}</td>
                                        <!-- tax area start -->
                                        
                                        <td rowspan="5">
                                        @if(count($row->taxs) > 0)
                                            @foreach($row->taxs as $data)
                                            <div class="row">
                                                <div class="col">
                                                    <span>On {{$data->taxDescription}} @ {{$data->baseonamount}} </span>
                                                </div>
                                                <div class="col">
                                                    = {{$data->amount}}
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                           
                                            <div class="row">
                                                <div class="col text-center"><strong>No Tax Amount Found!</strong></div>
                                            </div>
                                           @endif
                                           
                                        </td>
                                    </tr>
                                    <tr class="thead-light">
                                        <th scope="col">Room No</th>
                                        <th scope="col">CheckIn Date</th>
                                        <th scope="col">Checkout Date</th>
                                        <th scope="col">No Of Night</th>
                                    </tr>
                                   
                                    <tr>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$row->checkout_date}}</td>
                                        <td>{{$row->day}}</td>

                                    </tr>
                                    
                                    <tr>
                                        <th scope="col">Booking Type</th>
                                        <th scope="col">Room Amount</th>
                                        <th scope="col">Food Amount</th>
                                        <th scope="col">Ep/Laundry Amount</th>
                                    </tr>

                                    <tr>

                                        @if($row->booking_type == 2)
                                        <td>Group Booking</td>
                                        @else
                                        <td>Individual</td>
                                        @endif
                                        <td>{{round($row->room_amount,2)}}</td>
                                        <td>{{round($row->fb_amount,2)}}</td>
                                        <td>{{round($row->extra_service_amount,2)}}</td>

                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead class="bg-success">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Voucher Type</th>
                                        <th scope="col">Payment Mode</th>
                                        <th scope="col">Voucher No</th>
                                        <th scope="col">Debit</th>
                                        <th scope="col">Credit</th>
                                        <th scope="col">Against</th>
                                    </tr>
                                </thead>
                                <tbody>
                      
                                    <tr>
                                        <td>{{$row->TransectionDate}}</td>
                                        <td>{{$row->voucher_type}}</td>
                                        <td></td>
                                        <td>{{$row->voucherNo}}</td>
                                        
                                        <td>{{$row->TransectionAmount}}</td>
                                        <td>{{abs($row->TransectionAmount)}}</td>
                                        <td>Booking</td>
                                    </tr>
                            
                                
                                    <tr>
                                        <th colspan="6" class="text-right">Gross Amount</th>
                                        <td> {!!$currency->symbol ?? ' '!!} {{round($row->gross_amount,2)}}</td>
                                    </tr>
                                </tbody>
                            </table>




                        </div>
                    </div>

                </div>
    @endforeach
@else
                
                <div class="card">
                    <div class="card-body ">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">No Data Found!</th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
             
@endif

            </div>