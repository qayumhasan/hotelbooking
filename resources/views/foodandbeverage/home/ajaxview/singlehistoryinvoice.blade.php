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
                        <tr>
                            <td>{{$alldata->item_name}}</td>
                            <td>{{$alldata->qty}}</td>
                            <td>{{$alldata->item_rate}}</td>
                            <td>{{$alldata->amount}}</td>
                        </tr>
                        
                    </tbody>
                    
                </table>
            </div>
            <div class="col-md-12 text-right mb=-2">
                <hr>
                <p style="font-size:11px">Net Amount:{{$alldata->amount}}</p>
                <hr>
                <p style="font-size:11px">Gross Amount:{{$alldata->amount}} </p>
            </div>
            
            <div class="col-md-6 text-left">
                <p style="font-size:11px">Signature: </p>
            </div>
            <div class="col-md-6 text-right">
                <p style="font-size:11px">Demo User: </p>
            </div>
        </div> 