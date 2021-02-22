@php
date_default_timezone_set("Asia/Dhaka");
$current =date("d/m/Y");
$time = date("h:i");
@endphp

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
                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>

        </div>
    </div>


    <div class="modal-footer text-center mx-auto">
        <input type="hidden" id="history_table_no" value="{{$kotdetailamounts->table_no ?? ''}}" />
        <button type="button" id="historysave" class="btn btn-info">Save</button>
        <button type="button" id="historysaveandprint" class="btn btn-primary savepritbtn">Save & Print</button>
    </div>
</div>

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
        $('#calculation_on').change(function(e){
            var calculation_on =e.target.value;
            var tax_id =$('#tax_discription').find(":selected").val();
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
                data:{
                    tax_id:tax_id,
                    calculation_on:calculation_on,
                    base_on:base_on,
                    rate:rate,
                    invoice_no:invoice_no
                },  
                success: function(data) {
                    $('#rate_alt').html('');  
                    $('#amounthidden').val(data);
                    $('#amountshow').val(data);

                },
                error:function(err){
                    if(err.responseJSON.errors.rate){
                        $('#rate_alt').html('Rate Fields must not be empty!');
                    }
                }
            });



        })

    });

    // add to grid

    function addToGrid(e){
                var calculation_on =$('#calculation_on').find(":selected").val();
                var tax_id =$('#tax_discription').find(":selected").val();
                var base_on = $('#base_on').find(":selected").val();
                var rate = $('#rate').val();
                var amount= $('#amountshow').val();
                var invoice_no = $('#invoice_no_area').val();


                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ url('/admin/restaurant/chui/menu/tax/add/to/grid') }}",
                data:{
                    tax_id:tax_id,
                    amount:amount,
                    base_on:base_on,
                    rate:rate,
                    invoice_no:invoice_no,
                    calculation_on:calculation_on
                },  
                success: function(data) {
                    console.log(data);
                    $('#taxarea').empty();
                    $('#taxarea').append(data);

                    // remove previous field

                    var calculation_on =$('#calculation_on').val(' ');
                    var tax_id =$('#tax_discription').val(' ');
                    var base_on = $('#base_on').val(' ');
                    var rate = $('#rate').val(' ');
                    var amount= $('#amountshow').val(0);

                },
                error:function(err){
                    if(err.responseJSON.errors.rate){
                        $('#rate_alt').html('Rate Fields must not be empty!');
                    }
                }
            });
                
    }
</script>