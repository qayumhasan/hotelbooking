<div class="row">
    <div class="col-md-12 text-center">
        <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
    </div>
    <div class="col-md-12 text-center">
        <h4>{{$companyinformation->company_name}}</h4>
        <p>{{$companyinformation->address}}</p>
    </div>
    <div class="col-md-6 text-center">
        <p style="padding:5px 0px; background:#000;color:#fff">Invoice</p>
    </div>
    <div class="col-md-6 text-center">
        <p style="padding:5px 0px; background:#f7f7f7;color:#000">{{$orderhead->invoice_no}}</p>
    </div>
    <div class="col-md-12 text-left">
        <h4 style="font-size:12px">Waiter Name: {{$orderdetails->first()->waiter->employee_name?? ''}}</h4>
        <p style="font-size:11px">Table No: {{$orderdetails->first()->tableName->table_no?? ''}}</p>
    </div>
    <div class="col-md-6 text-left">
        <!-- <p style="font-size:11px">Booking No: 209876</p> -->
    </div>
    <div class="col-md-6 text-right">
        <p style="font-size:11px">Billing Date: {{$orderhead->payment_date}}</p>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered mt-4">
            <thead>
                <tr class="bg-secondary">
                    <th scope="col">Item Name</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>

                </tr>
            </thead>
            <tbody>
                @if(count($orderdetails) > 0)
                @foreach($orderdetails as $row)

                <tr class="deletehistory">
                    <td>{{$row->item->item_name?? ''}}</td>
                    <td>{{$row->qty}}</td>
                    <td>{{$row->rate}}</td>
                    <td>{{$row->amount}}</td>
                <tr>

                    @endforeach
                @else
                <tr>
                    <th colspan="6" class="text-center">No Data Found!</th>
                </tr>
                @endif




            </tbody>

        </table>
    </div>
    <div class="col-md-12 text-right mb=-2">
        <hr>
        <p style="font-size:11px">Net Amount:{!!$currency->symbol ?? ' '!!} {{$orderhead->total_amount}}</p>
        <hr>
        <p style="font-size:11px">Gross Amount:{!!$currency->symbol ?? ' '!!} {{$orderhead->gross_amount}} </p>
    </div>

    <div class="col-md-6 text-left">
        <p style="font-size:11px">Signature: </p>
    </div>
    <div class="col-md-6 text-right">
        <p style="font-size:11px">Demo User: </p>
    </div>
</div>