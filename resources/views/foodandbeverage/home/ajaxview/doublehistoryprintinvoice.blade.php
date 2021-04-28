        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
            </div>
            <div class="col-md-12 text-center">
                <h4>{{ $companyinformation->company_name }}</h4>
                <p>{{ $companyinformation->mobile }}</p>
            </div>
            <div class="col-md-6 text-center">
                <p style="padding:5px 0px; background:#000;color:#fff">Invoice</p>
            </div>
            <div class="col-md-6 text-center">
                <p style="padding:5px 0px; background:#f7f7f7;color:#000">{{$alldata->invoice_id}}</p>
            </div>
            <div class="col-md-12 text-left">
                <h4 style="font-size:12px">Guest Name: {{$alldata->guest_name}}</h4>
                <p style="font-size:11px">Booking No: {{$alldata->booking_no}}</p>
            </div>
            <div class="col-md-6 text-left">
                <!-- <p style="font-size:11px">Booking No: 209876</p> -->
            </div>
            <div class="col-md-6 text-right">
                <p style="font-size:11px">Room No: {{$alldata->room_no}}</p>
            </div>
            <div class="col-md-12">
                <table width="100%" style="font-size:10px;">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_amount=0;
                    @endphp
                    @foreach($alldatadetails as $val)
                        <tr>
                            <td>{{$val->item_name}}</td>
                            <td>{{$val->qty}}</td>
                            <td>{{$val->item_rate}}</td>
                            <td>{{$val->amount}}</td>
                        </tr>
                        @php
                            $total_amount=$total_amount + $val->amount;
                        @endphp
                    @endforeach
                    </tbody>
                    
                </table>
            </div>
            <div class="col-md-12 text-right mb=-2">
                <hr>
                <p style="font-size:11px">Net Amount:{{$total_amount}}</p>
                <hr>
                <p style="font-size:11px">Gross Amount:{{$total_amount}} </p>
            </div>
            
            <div class="col-md-6 text-left">
                <p style="font-size:11px">Signature: </p>
            </div>
            <div class="col-md-6 text-right">
                <p style="font-size:11px">Demo User: </p>
            </div>
        </div> 