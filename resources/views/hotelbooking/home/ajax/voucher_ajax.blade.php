@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$bookingno = rand(11111,99999);
$time = date("h:i");
@endphp

@section('content')








    <div class="row">
        <div class="col-sm-12 col-lg-12">

        <form action="{{route('admin.transection.checkout.create')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">

                                        
                                        <table class="table table-borderless">
                                            <tbody>
                                               
                                                <tr>
                                                    <td><label>Narration:</label></td>
                                                    <td colspan="5">
                                                     <input type="hidden" id="voucher_name" name="voucher_name" value="Cash Receipt Voucher">
                                                     <input type="hidden" name="reference" value="{{$guestname->booking_no}}">
                                                        <textarea name="narration" class="form-control noradious"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td><label>Sourch Cash:</label></td>
                                                        <td colspan="5">
                                                            @php
                                                            $datasourche=App\Models\ChartOfAccount::where('maincategory_code',19)->get();

                                                            $allsubcategoryone=App\Models\AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
                                                            $allsubcategorytwo=App\Models\AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();
                                                            @endphp
                                                            <select id="account_head_main" name="account_head_main" class="form-control noradious">
                                                                <option value="">--Select--</option>
                                                                @foreach($datasourche as $sorch_ofaccgg)
                                                                <option value="{{$sorch_ofaccgg->code}}">{{$sorch_ofaccgg->desription_of_account}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" value="" name="sourch_cate_code" id="sourch_cate_code">
                                                            <input type="hidden" value="" name="sourch_Accountcate_code" id="sourch_Accountcate_code">
                                                            <input type="hidden" value="" name="sourch_subcate_codeone" id="sourch_subcate_codeone">
                                                            <input type="hidden" value="" name="sourch_subcate_codetwo" id="sourch_subcate_codetwo">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Account Head:</label></td>
                                                        <td colspan="5">
                                                            @php
                                                            $allguest=App\Models\Guest::where('id',$guestname->guest_id)->first();

                                                            @endphp

                                                            <input type="hidden" id="account_head" name="account_head" value="{{$allguest->guest_id}}">


                                                            <input type="text" class="form-control" value="{{$guestname->guest_name}}" disabled>

                                                            <span style="color:red" id="accont_head_err"></span>
                                                            <input type="hidden" value="" name="acchead_cate_code" id="acchead_cate_code">
                                                            <input type="hidden" value="" name="acchead_Accountcate_code" id="acchead_Accountcate_code">
                                                            <input type="hidden" value="" name="acchead_subcate_codeone" id="acchead_subcate_codeone">
                                                            <input type="hidden" value="" name="acchead_subcate_codetwo" id="acchead_subcate_codetwo">


                                                            <input type="hidden" name="reference" value="{{$guestname->booking_no}}">

                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td class="qty" style="display:none"> <input type="text" id="qty" name="qty" class="form-control noradious" placeholder="Qty"></td>
                                                        <td class="qty" style="display:none"> <input type="text" id="price" name="price" class="form-control noradious" placeholder="Price"></td>
                                                        <td><label>Remarks:</label></td>
                                                        <td colspan="2">
                                                            <input type="text" id="remarks" name="remarks" class="form-control noradious">
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-sm shadow-showcase">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php
                                                    $year= Carbon\Carbon::now()->format('Y');
                                                    $date= Carbon\Carbon::now()->format('d');
                                                    $orderhed=App\Models\AccountTransectionHead::orderBy('id','DESC')->first();
                                                    if($orderhed){
                                                    $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
                                                    }else{
                                                    $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
                                                    }
                                                    if($orderhed){
                                                    $vno='CRV'.$year.'-'.$date.'-H-'.$orderhed->id;
                                                    }else{
                                                    $vno='CRV'.$year.'-'.$date.'-H-'.'0';
                                                    }
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="fname">Voucher No: *</label>
                                                        <input type="text" class="form-control noradious newinvoice" value="{{$vno}}" disabled>
                                                        <input type="hidden" name="invoice" id="invoice" class="newinvoice" value="{{$vno}}">
                                                        <input type="hidden" name="hiddeninvoice" id="hiddeninvoice" class="hiddeninvoice" value="{{$invoice}}">
                                                        <input type="hidden" name="accounttransecti_id" id="accounttransecti_id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-bottom:15px">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">Voucher Date: *</label>
                                                        <input type="text" id="date" name="date" class="form-control noradious datepicker" value="{{$current}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Advice:</label>
                                                        <input type="text" name="advice" class="form-control noradious" id="staticEmail" value="">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="card shadow-sm shadow-showcase">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-12 col-form-label">Amount:</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control noradious amount" id="amount" name="amount">
                                                            <span style="color:red;font-size:10px;" id="accont_amount"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <select name="amount_cate" id="amount_cate" class="form-control noradious">
                                                                <!-- <option value="Debit">Debit</option> -->
                                                                <option value="Cradit" selected>Cradit</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <a id="additem" class="btn-sm" style="padding: 10px;
    background: #616060;
    color: #fbfbfb;
    cursor: pointer;">Add</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">All Transection Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="transectiondata">




                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#voucher_type').on('change', function() {
            var voucher_type = $(this).val();

            if (voucher_type) {
                $.ajax({
                    url: "{{  url('/get/admin/vouchertype/voucherno/all/') }}/" + voucher_type,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        $(".newinvoice").val(data);
                        alldata();

                    }
                });
            } else {

            }

        });
    });
</script>

<!-- voucher type wise sourh account -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#voucher_type').on('change', function() {
            var voucher_type = $(this).val();


            if (voucher_type) {
                $.ajax({
                    url: "{{  url('/get/admin/vouchertype/sourchaccount/') }}/" + voucher_type,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        //console.log(data);
                        $('#ref_in').empty();
                        $('#ref_in').append(' <option>--select--</option>');
                        $.each(data, function(index, districtObj) {

                            $('#ref_in').append('<option value="' + districtObj.desription_of_account + '">' + districtObj.desription_of_account + '</option>');
                        });

                    }
                });
            } else {

            }

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#voucher_type').on('change', function() {
            var voucher_type = $(this).val();
            //alert("okkkkkk");

            if (voucher_type) {
                $.ajax({
                    url: "{{  url('/get/admin/vouchertype/accountheadaccount/') }}/" + voucher_type,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        console.log(data);
                        $('#ref_inss').empty();
                        $('#ref_inss').append(' <option>--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#ref_inss').append('<option value="' + districtObj.desription_of_account + '">' + districtObj.desription_of_account + '</option>');
                        });

                    }
                });
            } else {

            }

        });
    });
</script>




<script>
    $(document).ready(function() {
        $('#account_head_main').on('change', function() {
            var account_head = $(this).val();
            //alert(account_head);
            if (account_head) {
                $.ajax({
                    url: "{{  url('/get/admin/accounthead/checkbok/all') }}/" + account_head,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#cheque_reference').empty();
                        $('#cheque_reference').append(' <option value="">--select--</option>');
                        $.each(data, function(index, districtObj) {
                            $('#cheque_reference').append('<option value="' + districtObj.id + '">' + districtObj.check_number + '</option>');
                        });
                        alldata();

                    }
                });
            } else {

            }

        });
    });
</script>



</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#changeVoucher').on('click', function() {
            var invoice = $("#invoice").val();

            if (invoice) {
                $.ajax({
                    url: "{{  url('/get/admin/vouchertype/open/voucher/') }}/" + invoice,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        var item = document.querySelector('#voucher_type').disabled = false;
                        $("#plus_icon").hide();
                        alldata();

                    }
                });
            } else {

            }

        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#voucher_type').on('change', function() {

            var mainval = $(this).val();
            $("#voucher_name").val(mainval);
            var item = document.querySelector('#voucher_type').disabled = true;
            alldata();


        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#voucher_type').on('change', function() {
            $("#plus_icon").show();

            var v_val = $(this).val();
            if (v_val == "Bank Receipt Voucher") {
                $("#check_r").show();
            } else if (v_val == "Bank Payment Voucher") {
                $("#check_r").show();
            } else {
                $("#check_r").hide();
            }
            alldata();

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#mainqty").on('click', function() {

            if ($(this).is(":checked")) {
                $(".qty").show();
            } else {
                $(".qty").hide();
            }

        });

        $("#mainsubheadone").on('click', function() {

            if ($(this).is(":checked")) {
                $(".subheadone").show();
            } else {
                $(".subheadone").hide();
            }

        });
        $("#mainsubheadtwo").on('click', function() {

            if ($(this).is(":checked")) {
                $(".subheadtwo").show();
            } else {
                $(".subheadtwo").hide();
            }

        });



    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#account_head_main').on('change', function() {
            var account_head = $(this).val();
            if (account_head) {
                $.ajax({
                    url: "{{  url('/get/admin/sourchofaccount/all/') }}/" + account_head,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#sourch_cate_code").val(data.category_code);
                        $("#sourch_Accountcate_code").val(data.maincategory_code);
                        $("#sourch_subcate_codeone").val(data.subcategoryone_code);
                        $("#sourch_subcate_codetwo").val(data.subcategorytwo_code);
                    }
                });
            } else {
                //alert('danger');
            }

        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#account_head').on('change', function() {
            var account_head = $(this).val();
            //alert(account_head);
            if (account_head) {
                $.ajax({
                    url: "{{  url('/get/admin/headofaccount/all/') }}/" + account_head,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#acchead_cate_code").val(data.category_code);
                        $("#acchead_Accountcate_code").val(data.maincategory_code);
                        $("#acchead_subcate_codeone").val(data.subcategoryone_code);
                        $("#acchead_subcate_codetwo").val(data.subcategorytwo_code);

                    }
                });
            } else {
                // alert('danger');
            }

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#additem').on('click', function() {
            var vouchertype = $("#voucher_type").val();
            if (vouchertype == '') {
                alert("Please select Voucher Type");

            } else {
                // alert("ok");
                var subcategory_codetwo = $("#subcategory_codetwo").val();
                var subcategory_codeone = $("#subcategory_codeone").val();
                var remarks = $("#remarks").val();
                var qty = $("#qty").val();
                var price = $("#price").val();
                var account_head = $("#account_head").val();
                var account_head_main = $("#account_head_main").val();
                var location = $("#location").val();
                var amount = $(".amount").val();
                
                var amount_cate = $("#amount_cate").val();
                var invoice = $("#invoice").val();
                var date = $("#date").val();
                var accounttransecti_id = $("#accounttransecti_id").val();
                //   hidden value
                var sourch_cate_code = $("#sourch_cate_code").val();
                var sourch_Accountcate_code = $("#sourch_Accountcate_code").val();
                var sourch_subcate_codeone = $("#sourch_subcate_codeone").val();
                var sourch_subcate_codetwo = $("#sourch_subcate_codetwo").val();

                var acchead_cate_code = $("#acchead_cate_code").val();
                var acchead_Accountcate_code = $("#acchead_Accountcate_code").val();
                var acchead_subcate_codeone = $("#acchead_subcate_codeone").val();
                var acchead_subcate_codetwo = $("#acchead_subcate_codetwo").val();
                var hiddeninvoice = $("#hiddeninvoice").val();
                var cheque_reference = $("#cheque_reference").val();

                //alert(voucher_name);
                $.ajax({
                    type: 'GET',
                    url: "{{route('account.transection.insert')}}",
                    //data: $('#tax_cal').serializeArray(),
                    data: {

                        subcategory_codetwo: subcategory_codetwo,
                        subcategory_codeone: subcategory_codeone,
                        remarks: remarks,
                        qty: qty,
                        price: price,
                        account_head: account_head,
                        account_head_main: account_head_main,
                        location: location,
                        amount: amount,
                        amount_cate: amount_cate,
                        invoice: invoice,
                        date: date,
                        accounttransecti_id: accounttransecti_id,

                        sourch_cate_code: sourch_cate_code,
                        sourch_Accountcate_code: sourch_Accountcate_code,
                        sourch_subcate_codeone: sourch_subcate_codeone,
                        sourch_subcate_codetwo: sourch_subcate_codetwo,

                        acchead_cate_code: acchead_cate_code,
                        acchead_Accountcate_code: acchead_Accountcate_code,
                        acchead_subcate_codeone: acchead_subcate_codeone,
                        acchead_subcate_codetwo: acchead_subcate_codetwo,
                        hiddeninvoice: hiddeninvoice,
                        cheque_reference: cheque_reference,




                    },

                    success: function(data) {
                        $('#accont_head_err').html("");
                        $('#subcategory_codetwo').val("");
                        $('#subcategory_codeone').val("");
                        $('#remarks').val("");
                        $('#qty').val("");
                        $('#price').val("");
                        $('#account_head').val("");
                        $('#location').val("");
                        $('#amount').val("");
                        $('#accounttransecti_id').val("");
                        $('#account_head_main').val("");


                        $('#sourch_cate_code').val("");
                        $('#sourch_Accountcate_code').val("");
                        $('#sourch_subcate_codeone').val("");
                        $('#sourch_subcate_codetwo').val("");

                        $('#acchead_cate_code').val("");
                        $('#acchead_Accountcate_code').val("");
                        $('#acchead_subcate_codeone').val("");
                        $('#acchead_subcate_codetwo').val("");
                        $('#cheque_reference').val("");



                        alldata();

                    },

                    error: function(err) {
                        $('#accont_head_err').html(err.responseJSON.errors.account_head[0]);
                        $('#accont_amount').html(err.responseJSON.errors.amount[0]);
                    }

                });
            }




        });
    });
</script>

<!-- tax include script-->

<script>
    function alldata() {
        //alert("ok");
        var invoice = $("#invoice").val();

        $.post('{{ url('/get/alldatatransection/data/') }}/'+invoice, {
                _token: '{{ csrf_token() }}'
            },
            function(data) {

                $('#transectiondata').html(data);

            });

    }

    alldata();
</script>



<script>
    function Datadelete(el) {
        //alert(el.value);
        $.post('{{route('get.transection.delete')}}', {
                _token: '{{ csrf_token() }}',
                tran_id: el.value
            },
            function(data) {

                alldata();
            });


    }
</script>







<script>
function editdata(el) {
       
        $.post('{{route('get.alldatatransection.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                // console.log(data)

                $("#location").val(data.location);
                $("#account_head").val(data.account_head_details);

                $("#account_head_main").val(data.account_head_details);

                $("#price").val(data.price);
                $("#accounttransecti_id").val(data.id);

                if (data.qty) {
                    $(".qty").show();
                    $("#qty").val(data.qty);


                    var checkeditem = document.querySelector('#mainqty');
                    console.dir(checkeditem.checked = true);

                } else {
                    var checkeditem = document.querySelector('#mainqty');
                    console.dir(checkeditem.checked = false);
                    $(".qty").hide();

                }
                if (data.subcategory_codeone) {
                    var checkeditem = document.querySelector('#mainsubheadone');
                    console.dir(checkeditem.checked = true);
                    $(".subheadone").show();
                    $("#subcategory_codeone").val(data.subcategory_codeone).selected

                } else {
                    var checkeditem = document.querySelector('#mainsubheadone');
                    console.dir(checkeditem.checked = false);
                    $(".subheadone").hide();
                }
                if (data.subcategory_codetwo) {
                    var checkeditem = document.querySelector('#mainsubheadtwo');
                    console.dir(checkeditem.checked = true);
                    $(".subheadtwo").show();
                    $("#subcategory_codetwo").val(data.subcategory_codetwo).selected

                } else {
                    var checkeditem = document.querySelector('#mainsubheadtwo');
                    console.dir(checkeditem.checked = false);
                    $(".subheadtwo").hide();
                }
                $("#qty").val(data.qty);
                $("#remarks").val(data.remarks);


                if (data.dr_amount) {

                    $("#amount").val(data.dr_amount);
                    $("#amount_cate").val('Debit').selected;


                } else {


                    $("#amount").val(data.cr_amount);
                    $("#amount_cate").val('Cradit').selected;

                }



            });


    }
</script>

