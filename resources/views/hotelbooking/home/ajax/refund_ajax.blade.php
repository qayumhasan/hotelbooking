@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$bookingno = rand(11111,99999);
$time = date("h:i");
@endphp

@section('content')



<form action="{{route('admin.checkout.refund.submit',$booking_no)}}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <div class="card">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="modal-footer">

                            <input type="hidden" value="{{$voucher_no}}" name="voucher_no" />
                            <span class="btn btn-secondary mr-auto">Voucher No: {{$voucher_no}}</span>

                            <button type="button" class="btn btn-primary">
                                <input type="text" class="form-control" name="date" value="{{$current}}" />
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="bg-light">
                            <div class="row p-4">
                                <div class="col-sm-1">
                                    <span>Dr/Cr:</span>
                                </div>
                                <div class="col-sm-2">
                                    <span>Particulars:</span>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-3 text-center">
                                    Debit({!!$currency->name ?? ' '!!})
                                </div>
                                <div class="col-sm-3 text-center">
                                    Credit({!!$currency->name ?? ' '!!})
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row p-4">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>Cr.</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>Dr.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                
                                

                                <div class="form-group">

                                    <select name="credit" class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option value="bank">Bank</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">

                                    <select name="debit" class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>{{$guestname->guest_name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row p-4">
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <input type="text" disabled class="form-control form-control-sm" id="exampleFormControlInput1">
                                </div>
                                <br>
                                <div class="form-group">

                                    <input type="number" disabled class="form-control form-control-sm" id="showdrvalue">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">

                                    <input type="number" name="amount" required onkeyup="getDebetValue(this)" class="form-control form-control-sm" id="exampleFormControlInput1">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="text" disabled class="form-control form-control-sm" id="exampleFormControlInput1">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Narration :</label>
                            <div class="col-sm-10">
                                <input name="remarks" type="text" class="form-control form-control-sm" id="staticEmail">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row p-4">
                <div class="col-sm-8">
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary mx-auto">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>




    <script>
        function getDebetValue(e) {
            $('#showdrvalue').val(e.value);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#amountmodal').modal('show');
        })
    </script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
        });
    </script>
    