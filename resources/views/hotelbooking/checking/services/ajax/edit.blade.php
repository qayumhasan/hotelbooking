<style>
    .control-label {
        font-size: 10px;
    }

    .editbtn {
        border: none;
        background: none;
    }
</style>

@php
                    date_default_timezone_set("Asia/Dhaka");
                    $servicedate = date("d/m/Y");
                    $servicetime = date("h:i");
                    @endphp
<div id="deleted_extra">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 card basic-drop-shadow shadow-showcase mt-4 p-4">
            <form action="{{route('admin.checkin.service.update')}}" method="post">
                @csrf

                <div class="row mt-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Date/Time:</label>
                    <div class="col-sm-4">
                        <input type="text" required name="service_date" class="controll-from editdatepicker" id="service_date">
                        <input type="hidden" name="service_id" class="controll-from" id="service_id">
                        <input type="hidden" name="service_no" class="controll-from" id="service_no">
                    </div>
                    <div class="col-sm-4">
                        <input type="time" required name="service_time" class="controll-from" id="service_time">
                    </div>
                </div>


        

                <div class=" row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services Category:</label>
                    <div class="col-sm-8">
                        <select class="controll-from" id="service_category_area" name="service_category" required>
                            <option disabled selected>---Select Category----</option>
                            @foreach($menucategores as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class=" row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services:</label>
                    <div class="col-sm-8">
                        <select class="controll-from" id="services" name="services" required>
                            <option disabled selected>---Select service----</option>
                           
                            @foreach($items as $row)
                            <option value="{{$row->id}}">{{$row->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Remarks:</label>
                    <div class="col-sm-8">
                        <input type="text" name="remarks" class="controll-from" id="remarks">
                    </div>

                </div>
                <div class="row mt-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Rate:</label>
                    <div class="col-sm-8">
                        <input type="number" required name="rate" class="controll-from" id="rate">
                    </div>

                </div>
                <div class="row mt-2">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Qty:</label>
                    <div class="col-sm-8">
                        <input type="number" required name="qty" class="controll-from" id="qty">
                    </div>

                </div>

                <div class="row mt-2">
                    <label class="col-sm-4 col-form-label text-center control-label" for="defaultCheck1">
                        Third Party Supplier
                    </label>
                    <div class="col-sm-3">
                        <input id="check_third_area" class="form-check-input check_third" name="is_third" type="checkbox" value="1"> Yes
                    </div>
                </div>
                <div class=" row third_party" id="third_party_area_main">
                    <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label"></label>
                    <div class="col-sm-8">
                    <select class="controll-from" id="third_party_item" name="third_party">
                        <option disabled selected>--- Select Suppliers ---</option>
                        @foreach($supliers as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <label class="col-sm-4 col-form-label text-center control-label" for="defaultCheck1">
                        Is Return:
                    </label>
                    <div class="col-sm-3">
                        <input id="is_return" class="form-check-input is_return" name="is_return" type="checkbox" value="1"> Yes/No
                    </div>
                </div>

                <div class=" row return" id="return_time">
                    <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Return Date/Time:</label>
                    <div class="col-sm-4">
                        <input type="text" name="return_date" class="controll-from editdatepicker" id="return_service_date" value="{{$servicedate}}">
                    </div>

                    <div class="col-sm-4">
                        <input type="time" name="return_time" class="controll-from" value="{{$servicetime}}" id="return_service_time">
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-sm-10 p-2 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

        </div>
        </form>
    </div>


    <div class="row">
        <div class="col-md-12 card basic-drop-shadow shadow-showcase mt-4 p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="control-label" scope="col">Service No</th>
                        <th class="control-label" scope="col">Room No</th>
                        <th class="control-label" scope="col">Services</th>
                        <th class="control-label" scope="col">Services Date</th>
                        <th class="control-label" scope="col">Operator</th>
                        <th class="control-label" scope="col">rate</th>
                        <th class="control-label" scope="col">Qty</th>
                        <th class="control-label" scope="col">Amount</th>
                        <th class="control-label" scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @if(count($services) > 0)
                    @foreach($services as $row)
                    <tr>
                        <th scope="row">{{$row->service_no}}</th>
                        <td>{{$row->checkin->room_no ?? ''}}</td>
                        <td>{{$row->services}}</td>
                        <td>{{$row->service_date}}</td>

                        <td>gsdg</td>
                        <td>{{$row->rate}}</td>
                        <td>{{$row->qty}}</td>

                        <td>{{$row->rate*$row->qty}}</td>
                        <td>
                            <button class="editbtn" data-id="{{$row}}"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>

                    @endforeach
                    @else
                    <tr>
                        <td>No Services Found!</td>
                    </tr>
                    @endif


                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // $('.third_party').hide();
    $('#return_time').hide();
    $('.editbtn').click(function(e) {

        var data = $(this).data("id");
        console.log(data);
        $('#service_date').val(data.service_date);
        $('#service_id').val(data.id);
        $('#service_no').val(data.service_no);
        $('#service_time').val(data.service_time);
        $('#service_category_area').val(data.service_category).selected;
        $('#services').val(data.services).selected;
        $('#remarks').val(data.remarks);
        $('#rate').val(data.rate);
        $('#qty').val(data.qty);


        if (data.is_third == '1') {
            $('.check_third').prop('checked', true);
            $('.third_party').show();
            $('#third_party_item').val(data.third_party).selected;
            // $("#check_third").is(":checked")
        } else {
            $('.check_third').prop('checked', false);
            $('.third_party').hide();
        }

        if (data.is_return == '1') {
            $('#is_return').prop('checked', true);
            $('#return_time').show();
            $('#return_service_date').val(data.return_date);
            $('#return_service_time').val(data.return_time);
            // $("#check_third").is(":checked")
        } else {
            $('#is_return').prop('checked', false);
            $('#return_time').hide();
        }

    })

    $('#is_return').click(function(e) {
        if (e.currentTarget.checked == true) {
            $('#return_time').show();
        } else if (e.currentTarget.checked == false) {
            $('#return_time').hide();
        }
    });

    $('#check_third_area').click(function(e) {
        if (e.currentTarget.checked == true) {
            
            $('#third_party_area_main').show();
        } else if (e.currentTarget.checked == false) {
            $('#third_party_area_main').hide();
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('#services').change(function(params) {
            var id = params.target.value;
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/service/categores/') }}/"+id,
                
                success: function(data) {
                 document.querySelector('#rate').value = data.rate;
                }
            });
        });
    });
</script>

<script>
    $('.editdatepicker').datepicker(
        {
                format: 'dd/mm/yyyy',
            }
    );
</script>