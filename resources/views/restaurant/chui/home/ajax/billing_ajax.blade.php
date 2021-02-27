@php
date_default_timezone_set("Asia/Dhaka");
$current =date("d/m/Y");
$time = date("h:i");
@endphp
@if($kotdetailamounts)
<form id="billing_info_submit" action="{{url('admin/restaurant/chui/menu/history/kot/store')}}" method="post">
    <div class="modal-content printableAreasaveprint">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">History Of Table No <b><span id="table_no">{{$kotdetailamounts->tableName->table_no ?? ''}}</span></b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Table No:</th>
                        <td>{{$kotdetailamounts->tableName->table_no ?? ''}}</td>
                        <th scope="row">Waiter Name:</th>
                        <td>{{$kotdetailamounts->waiter->employee_name ?? ''}}</td>
                        <th scope="row">Date:</th>
                        <td>{{$kotdetailamounts->kot_date}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No of Pax:</th>
                        <td>
                            <input type="number" class="form-control form-control-sm" value="1" name="no_of_pax" />
                        </td>
                        <th scope="row">Invoice No:</th>
                        <td>{{$kotdetailamounts->invoice_id}}</td>
                        <th scope="row">Payment Date:</th>
                        <td>
                            <input type="text" value="{{$current}}" class="form-control form-control-sm datepicker" name="paymentdate" />
                        </td>
                    </tr>
                </tbody>
            </table>


            <table class="table table-bordered mt-4">
                <thead>
                    <tr class="bg-secondary">
                        <th scope="col">KOT Date</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Complementary</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($kotdetails) > 0)
                    @foreach($kotdetails as $row)

                    <tr class="deletehistory">
                        <th scope="row">{{$row->kot_date}}</th>
                        <td>{{$row->item->item_name?? ''}}</td>
                        <td>{{$row->qty}}</td>
                        <td>{{$row->rate}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->complementitem->item_name??''}}</td>
                    <tr>

                        @endforeach
                    <tr class="totalqtyarea">
                        <th scope="row"></th>
                        <th>Total Quentity</th>
                        <td>{{$kotdetailamounts->orderHead->number_of_qty ?? ''}}</td>
                        <th>Net Amount</th>
                        <td>{{$kotdetailamounts->orderHead->total_amount ?? ''}}</td>
                        <td>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <th colspan="6" class="text-center">No Data Found!</th>
                    </tr>
                    @endif




                </tbody>

            </table>
        </div>


        <!-- hidden field -->
        <input type="hidden" id="invoice_no_area" value="{{$kotdetailamounts->invoice_id}}" name="invoice_no">
        <input type="hidden" id="table_no_data" value="{{$kotdetailamounts->table_no}}" name="table_no">
        <input type="hidden" id="room_no_date" name="room_no">
        <!-- hidden field -->

        <div class="container">
            <div class="row border">
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tax Discription</label>
                        <select class="form-control form-control-sm" id="tax_discription">
                            @foreach($taxs as $row)
                            <option value="{{$row->id}}">{{$row->tax_description}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Calculation On</label>
                        <select class="form-control form-control-sm" id="calculation_on">
                            <option disabled selected>---- Select----</option>
                            <option value="1">Calculate On Gross Amount</option>
                            <option value="2">Calculate On Food Amount</option>
                            <option value="3">Calculate On Discount Amount</option>
                            <option value="4">Calculate On Net Amount</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Base On </label>
                        <select class="form-control form-control-sm base_on" id="base_on" name="base_on">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Rate </label>
                        <input type="number" id="rate" class="form-control form-control-sm" />
                        <small id="rate_alt" class="text-danger"></small>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Amount </label>
                        <input type="hidden" id="amounthidden" class="form-control form-control-sm" />
                        <input type="number" id="amountshow" disabled class="form-control form-control-sm" />
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1"> .</label><br>
                        <button type="button" onclick="addToGrid()" id="addtogrid" class="btn btn-sm btn-primary">Add To Grid</button>
                    </div>
                </div>
            </div>
        </div>

        @php
        $texdatas = App\Models\TaxDetails::where('invoice_id',$kotdetailamounts->invoice_id)->get();
        $resgross= App\Models\Restaurant_Order_head::where('invoice_no',$kotdetailamounts->invoice_id)->first();
        @endphp

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-secondary">
                                <th scope="col">Description</th>
                                <th scope="col">Calculation</th>
                                <th scope="col">Base On</th>
                                <th scope="col">Effect</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="taxarea">
                            @if(count($texdatas) > 0)
                            @foreach($texdatas as $row)
                            <tr>
                                <td scope="row">{{$row->tax_description}}</td>
                                <td>{{$row->CalculateOn[$row->calculation_id]}}</td>
                                <td>{{ucfirst($row->base_on)}}</td>
                                <td>{{$row->EffectOn[$row->effect]}}</td>

                                <td>{{$row->rate}}</td>
                                <td>{{round($row->amount,2)}}</td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th class="text-center" colspan="7">No Data Found!</th>
                            </tr>
                            @endif

                            <tr>

                                <th colspan="5" class="text-right">Discount Amount</th>
                                <td>0</td>

                            </tr>


                            <tr>

                                <th colspan="5" class="text-right">Gross Amount</th>
                                <td>{{round($resgross->gross_amount,2)}}</td>

                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row border">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Remarks</label>
                        <input type="text" name="remarks" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mobile No:</label>
                        <input type="text" name="mobile_no" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Payment Mode: </label>
                        <select class="form-control form-control-sm" name="payment_method" id="payment_mode">
                            <option disabled selected>---Select Payment Mode----</option>
                            <option value="1">Cash</option>
                            <option value="2">Card</option>
                            <option value="3">Mobile Money</option>
                            <option value="4">Credit</option>
                            <option value="5">Post To Room</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tbody id="payment_mode_insert">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal-footer text-center mx-auto">
            <input type="hidden" id="history_table_no" value="{{$kotdetailamounts->table_no ?? ''}}" />
            <button type="submit" id="historysave" class="btn btn-info">Save</button>
            <button type="submit" id="historysaveandprint" class="btn btn-primary savepritbtn">Save & Print</button>
        </div>
    </div>
</form>
@else
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="alart">
                <img src="{{asset('public/uploads/restaurant/sorry.jpg')}}" alt="" />
                <h4>Add Some KOT Items!</h4>
            </div>
        </div>
    </div>
</div>
@endif


<!-- invoice modal -->
<div class="modal fade" id="printmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content printableAreasaveprint">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <div class="container printableAreasaveprintsection" id="billinginvoice">



                                                   




               </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary mx-auto savepritbtnarea">Print</button>
      </div>
    </div>
  </div>
</div>

<script>
        $(function() {
            $(".savepritbtnarea").on('click', function() {

                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableAreasaveprintsection").printArea(options);
            });
        });
    </script>

<script>
    $(document).ready(function(){
        $('#historysaveandprint').click(function(){
            $('#printmodal').modal('show');
            var invoiceid =$('#invoice_no_area').val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/history/kot/print') }}/" + invoiceid,
            success: function(data) {
                $('#billinginvoice').empty();
                $('#billinginvoice').append(data);
            }
        });


        });
    });
</script>


<!-- 
<script>
    $(document).ready(function() {
        $('#historysaveandprint').click(function() {
            savehistory();



        });
    });



    $(document).ready(function() {
        $('#historysave').click(function() {
            savehistory();
        });
    });

    $(function() {
        $(".savepritbtn").on('click', function() {

            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprint").printArea(options);
        });
    });
</script> -->




<script>
    function savehistory() {
        var table_id = document.querySelector('#history_table_no').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/history/kot/store') }}/" + table_id,
            success: function(data) {
                console.log(data);
                if (data.msg == 1) {
                    $('.historymodal').modal('hide')
                    iziToast.success({
                        message: 'Kot Data Save Successfully!',
                        position: 'topCenter',
                    });
                } else {
                    iziToast.warning({
                        message: 'Sorry, Something went wrong!',
                        position: 'topCenter',
                    });
                }
            }
        });
    }
</script>



<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>

<script>
    $(document).ready(function() {
        $('#tax_discription').change(function(e) {
            var id = e.target.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/restaurant/chui/menu/get/tax/value') }}/" + id,
                success: function(data) {
                    $('#base_on').val(data.base_on).selected;
                    if (data.rate != null) {
                        $('#rate').val(data.rate)
                    } else {
                        $('#rate').val(data.amount)
                    }

                }
            });
        });



        // calculation on tax
        $('#calculation_on').change(function(e) {
            var calculation_on = e.target.value;
            var tax_id = $('#tax_discription').find(":selected").val();
            var base_on = $('#base_on').find(":selected").val();
            var rate = $('#rate').val();
            var invoice_no = $('#invoice_no_area').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ url('/admin/restaurant/chui/menu/get/tax/calculate') }}",
                data: {
                    tax_id: tax_id,
                    calculation_on: calculation_on,
                    base_on: base_on,
                    rate: rate,
                    invoice_no: invoice_no
                },
                success: function(data) {
                    $('#rate_alt').html('');
                    $('#amounthidden').val(data);
                    $('#amountshow').val(data);

                },
                error: function(err) {
                    if (err.responseJSON.errors.rate) {
                        $('#rate_alt').html('Rate Fields must not be empty!');
                    }
                }
            });



        })

    });

    // add to grid

    function addToGrid(e) {
        var calculation_on = $('#calculation_on').find(":selected").val();
        var tax_id = $('#tax_discription').find(":selected").val();
        var base_on = $('#base_on').find(":selected").val();
        var rate = $('#rate').val();
        var amount = $('#amountshow').val();
        var invoice_no = $('#invoice_no_area').val();
        var table_no = $('#table_no_data').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ url('/admin/restaurant/chui/menu/tax/add/to/grid') }}",
            data: {
                tax_id: tax_id,
                amount: amount,
                base_on: base_on,
                rate: rate,
                invoice_no: invoice_no,
                calculation_on: calculation_on,
                table_no: table_no
            },
            success: function(data) {
                console.log(data);
                $('#taxarea').empty();
                $('#taxarea').append(data);

                // remove previous field

                var calculation_on = $('#calculation_on').val(' ');
                var tax_id = $('#tax_discription').val(' ');
                var base_on = $('#base_on').val(' ');
                var rate = $('#rate').val(' ');
                var amount = $('#amountshow').val(0);

            },
            error: function(err) {
                if (err.responseJSON.errors.rate) {
                    $('#rate_alt').html('Rate Fields must not be empty!');
                }
            }
        });

    }
</script>

<script>
    $(document).ready(function() {
        $('#payment_mode').change(function(e) {
            var id = e.target.value;

            $('#payment_mode_insert').empty();
            // add card number
            if (id == 2) {
                $('#payment_mode_insert').append('<tr><th scope="row"><label for="exampleFormControlSelect1">Bank Name</label><select class="form-control form-control-sm" name="bank_name"><option value="1">AB Bank Limited</option><option value="2">Dhaka Bank Limited</option><option value="3">IFIC Bank Limited</option></select></th><td> <label for="exampleFormControlInput1">Card Number</label><input type="text" name="card_number" class="form-control form-control-sm" id="exampleFormControlInput1"></td></tr>');

                //    mobile money
            } else if (id == 3) {


                $('#payment_mode_insert').append('<tr><th scope="row"><label for="exampleFormControlSelect1">Mobile Number</label><input type="text" name="mobile_number" class="form-control form-control-sm" id="exampleFormControlInput1"></th><td> <label for="exampleFormControlInput1">Transaction Number</label><input type="text" class="form-control form-control-sm" name="trans_number" id="exampleFormControlInput1"></td></tr>');
                // credit balance
            } else if (id == 4) {
                $('#payment_mode_insert').append('<tr><th scope="row" class="text-right">Customar Name:</th><td><input type="text" class="form-control form-control-sm" name="customar_number" id="exampleFormControlInput1"></td></tr>');

                // post to room
            } else if (id == 5) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'get',
                    url: "{{ url('/admin/restaurant/chui/menu/select/room') }}",

                    success: function(data) {




                        if (data.length > 0) {

                            var item = '<tr>';
                            item += '<th scope = "col" >';
                            item += '<label for="staticEmail" class="col-sm-2 col-form-label" > Rooms </label> <div class = "col-sm-10" > <select onchange="getSelectedRoom(this)" class = "form-control form-control-sm select_item selected_room_data" > <option> ---Select A Room---- </option>';

                            data.forEach(ele => {
                                item += '<option value="' + ele.id + '"> ' + ele.room_no + ' </option>';
                            });

                            item += '</select> </div> </th><td scope ="col" id="getroomdata"></td> </tr>';
                            $('#payment_mode_insert').append(item);

                        }


                    }

                });
            }
        });
    });
</script>

<script>
    function getSelectedRoom(e) {
        var id = e.value;
        $('#room_no_date').val(id);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/select/room/data/get') }}/" + id,

            success: function(data) {

                $('#getroomdata').append('<h6>Guest Information:</h6><h6>Bookin No: <span>' + data.booking_no + '</span></h6><h6>Guest Name: <span>' + data.guest_name + '</span></h6><h6>Mobile No: <span>' + data.mobile + '</span></h6><h6>Check-In Date: <span>' + data.checkin_date + '</span></h6> <input type="hidden" name="booking_no" value="'+data.booking_no+'"/>');




            }

        });



    }
</script>