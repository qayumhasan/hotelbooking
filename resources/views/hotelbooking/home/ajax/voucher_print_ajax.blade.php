<div class="invoice-card printInvoice">
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
            <h4>Voucher</h4>
            <span>#{{$voucher->voucher_no}}</span>
        </div>

        <span id="date">{{$voucher->date}}</span>
    </div>

    <div class="invoice-details">
        <table class="invoice-table">
            <thead>
                <tr>
                    <td>Type</td>
                    <td class="text-center">Against</td>
                    <td class="text-center">Amount</td>
                </tr>
            </thead>

            <tbody>




                <tr class="row-data">
                    @if($voucher->type == 1)
                    <td>Recept</td>
                    @elseif($voucher->type == 0)
                    <td>Refund</td>
                    @endif
                    <td id="unit">Booking</td>
                    <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$voucher->amount}}</td>
                </tr>


                <tr class="calc-row">
                    <td  class="text-center"colspan="2">Total</td>
                    <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$voucher->amount}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
        $(document).ready(function() {
            $(".saveextraservice").on('click', function() {

                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printInvoice").printArea(options);
            });
        });
    </script>