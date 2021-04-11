<div class="modal-body printableAreasaveprint">






    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
        </div>
        <div class="col-md-12 text-center">

        </div>
        <div class="col-md-6 text-center">
            <p style="padding:5px 0px; background:#000;color:#fff">Invoice</p>
        </div>
        <div class="col-md-6 text-center">
            <p style="padding:5px 0px; background:#f7f7f7;color:#000">{{$orderhead->invoice_no}}</p>
        </div>
        <div class="col-md-12 text-left">
            <h4 style="font-size:12px">Waiter Name: {{$orderdetails->first()->waiter->employee_name ?? ' '}}</h4>
        </div>
        <div class="col-md-6 text-left">
            <!-- <p style="font-size:11px">Booking No: 209876</p> -->
        </div>
        <div class="col-md-6 text-right">
            <p style="font-size:11px">Table No: {{$orderdetails->first()->tableName->table_no ?? ' '}}</p>
        </div>
        <div class="col-md-12">
            <table class="table" style="font-size:10px;">
                <thead>
                    <tr>
                        <th scope="col">KOT Date</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Complementary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderdetails as $row)

                    <tr class="deletehistory">
                        <th scope="row">{{$row->kot_date}}</th>
                        <td>{{$row->item->item_name?? ''}}</td>
                        <td>{{$row->qty}}</td>
                        <td>{{$row->rate}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->complementitem->item_name??''}}</td>
                    <tr>

                        @endforeach
                </tbody>

            </table>
        </div>
        <div class="col-md-12 text-right mb=-2">
            <hr>
            <p style="font-size:11px">Number Of Quentity: <b>{{$orderhead->number_of_qty}}</b></p>
            <p style="font-size:11px">Gross Amount: <b>{!!$currency->symbol ?? ' '!!} {{$orderhead->total_amount}}</b> </p>
        </div>
    </div>





</div>

<div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary mx-auto savepritbtn">Print</button>
      </div>


      <script>
        $(function() {
            $(".savepritbtn").on('click', function() {
                $('#atglanceprintmodal').modal('hide');
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