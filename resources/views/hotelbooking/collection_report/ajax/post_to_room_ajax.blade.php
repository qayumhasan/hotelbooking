
            @if(count($postToRooms) > 0)
            @foreach($postToRooms as $row)
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">

                    <div class="card-body ">
                        <div class="table-responsive room_ajax_data">

                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th scope="col">SL</th>
                                        <th scope="col">Booking</th>
                                        <th scope="col">In Date</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Out Date</th>
                                        <th scope="col">Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$row->checkin->booking_no ?? ''}}</td>
                                        <td>{{$row->checkin->checkin_date ?? ''}}</td>
                                        <td>{{$row->checkin->guest_name ?? ''}}</td>
                                        <td>{{$row->checkin->company_name ?? ''}}</td>
                                        <td>{{$row->checkin->checkinstatus ?? ''}}</td>
                                        <td>{{$row->checkin->checkout->checkout_date ?? ''}}</td>
                                        <td>
                                            <a href="{{route('admin.post.to.room.invoice.print',$row->id)}}" class="btn btn-primary badge bg-info-light mr-2 invoicebtn" data-toggle="modal" data-target="#invoiceprint"><i class="las la-print"></i></a>
                                        </td>

                                    </tr>

                                    <tr class="bg-secondary">
                                        <th scope="col"></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Restaurant Name</th>
                                        <th scope="col">Room No</th>
                                        <th scope="col">Waiter</th>
                                        <th scope="col" class="text-center" colspan="2">Amount</th>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>{{$row->orderDetail->kot_date ?? ''}}</td>
                                        <td>{{$row->orderDetail->invoice_id ?? ''}}</td>

                                        <td>Durbar-Restaturant</td>
                                        <td>{{$row->checkin->room_no ?? ''}}</td>
                                        <td>{{$row->orderDetail->waiter->employee_name ?? ''}}</td>
                                        <td class="text-center" colspan="2">{{$row->gross_amount}}</td>

                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="6">Booking Total:</th>
                                        <td class="text-center" colspan="2">{{$row->gross_amount}}</td>
                                    </tr>

                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
         





            @endforeach

            @else
            <div class="col-sm-12 text-center">
                <h6 class="text-center">No Data Found!</h6>
            </div>
            @endif