<div class="invoice-card printfood">
    <style>
        .invoice_item:hover {
            background: gray;
            color: white;
            cursor: pointer;
        }


        .invoice-card {

            padding: 10px 2em;
            background-color: #fff;
            border-radius: 5px;
        }

        .invoice-card>div {
            margin: 5px 0;
        }

        .invoice-title {
            flex: 3;
        }

        .invoice-title #date {
            display: block;
            margin: 8px 0;
            font-size: 12px;
        }

        .invoice-title #main-title {
            display: flex;
            justify-content: space-between;
            margin-top: 2em;
        }

        .invoice-title #main-title h4 {
            letter-spacing: 2.5px;
        }

        .invoice-title span {
            color: rgba(0, 0, 0, 0.4);
        }

        .invoice-details {
            flex: 1;
            border-top: 0.5px dashed grey;
            border-bottom: 0.5px dashed grey;
            display: flex;
            align-items: center;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table thead tr td {
            font-size: 12px;
            letter-spacing: 1px;
            color: grey;
            padding: 8px 0;
        }

        .invoice-table thead tr td:nth-last-child(1),
        .row-data td:nth-last-child(1),
        .calc-row td:nth-last-child(1) {
            text-align: right;
        }

        .invoice-table tbody tr td {
            padding: 8px 0;
            letter-spacing: 0;
        }

        .invoice-table .row-data #unit {
            text-align: center;
        }

        .invoice-table .row-data span {
            font-size: 13px;
            color: rgba(0, 0, 0, 0.6);
        }

        .invoice-footer {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .invoice-footer #later {
            margin-right: 5px;
        }

        .btn#later {
            margin-right: 2em;
        }

        .company_info {
            font-size: 10px;
            font-weight: normal;
        }
    </style>
    <div class="invoice-title">
        <div id="main-title">
            <h4>INVOICE</h4>
            <span># {{$postToRooms->invoice_no}}</span>
        </div>

        <span id="date">Bill Date :{{$postToRooms->payment_date}}</span>
        <span id="date">Table No: {{$postToRooms->orderDetail->tableName->table_no ?? ''}}</span>
        <span id="date">Waiter: {{$postToRooms->orderDetail->waiter->employee_name ?? ''}}</span>
        <span id="date">Mode Of Payment: Post To Room</span>
    </div>

    <div class="invoice-details">
        <table class="invoice-table">
            <thead>
                <tr>
                    <td>PRODUCT</td>
                    <td>UNIT</td>
                    <td>Rate</td>
                    <td>Amount</td>
                </tr>
            </thead>

            <tbody>
            @php
                $totalfoodbill = 0;
            @endphp
            @if(count($postToRooms->orderDetails) >0)
            @foreach($postToRooms->orderDetails as $row)
               <tr>
                    <td>{{$row->item->item_name ?? ''}}</td>
                    <td>{{$row->qty}}</td>
                    <td>{{$row->rate}}</td>
                    <td class="text-right">{{$row->qty * $row->rate}}</td>
               </tr>
               @php
               $totalfoodbill = $totalfoodbill +$row->qty * $row->rate; 
               @endphp

            @endforeach
            @endif
                
                <tr class="calc-row border-top border-secondary">
                    <td colspan="3">Bill Amount</td>
                    <td>$ {{$totalfoodbill}}</td>
                </tr>


        <!-- tax info -->

            @if(count($postToRooms->taxheads) >0)
            @foreach($postToRooms->taxheads as $row)
               <tr>
                    <td>{{$row->effect}} : {{$row->taxdetails->tax_description ?? ''}} - {{$row->TaxRate}} On {{$row->Calculation}}</td>

                    <td colspan="3" class="text-right">{{$row->amount}}</td>
                    
               </tr>
               <tr style="border-top: 1px dashed;">
                    <th colspan="3" class="text-right">Total Amount:   </th>
                    <td class="text-right">{{$postToRooms->gross_amount}}</td>
               </tr>
               

            @endforeach
            @endif


            
            </tbody>
        </table>
    </div>


    <div class="invoice-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-outline-primary printbtn">Print</button>
    </div>


</div>



<script>
        $(function () {
            $(".printbtn").on('click', function () {
                
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printfood").printArea(options);
            });
        });
   </script>