@extends('housekipping.master')
@section('title', 'Issue Item edit | '.$seo->meta_title)
@section('content')



<style>
    .deletebtn {
        cursor: pointer;
        padding: 5%;
    }

    .tbodyborder {
        border: 2px solid red;
        padding: 150px;
    }
</style>

<div class="content-page">
    <form id="get_issue_to_room_data" action="{{route('admin.housekeeping.item.update')}}" method="post">
        @csrf
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Issue To Room</h4>
                            </div>
                            <!-- <span class="float-right mr-2">
                                <a href="#" class="btn btn-sm bg-primary">
                                    <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                                </a>
                            </span> -->
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-1 col-form-label"><b>Issue Date:</b></label>
                                <div class="col-sm-4">
                                    <input class="form-control datepicker" name="issue_date" id="issuedate" type="text" required value="{{$itemIssues->first()->issue_date}}">
                                    <small class="text-danger issue_date"></small>
                                </div>


                                @php
                                $data = array();
                                foreach($itemIssues as $row){

                                array_push($data,$row->room_id);
                                }

                                @endphp

                                <label for="inputPassword" class="col-sm-1 col-form-label"><b>Room No:</b></label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm" required id="select_room_no" name="room_id[]" multiple="multiple">
                                        @foreach($rooms as $row)
                                        <option {{in_array($row->id,$data)?'selected':''}} value="{{$row->id}}">{{$row->room_no}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger room_no"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card-header d-flex justify-content-between border">
                                    <div class="header-title">
                                        <h4 class="card-title">Issue To Room</h4>
                                    </div>
                                </div>
                                <div class="card border-righ border-bottom border-left p-5">


                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Item Name</label>
                                        <select class="form-control form-control-sm" id="item_name">
                                            @foreach($items as $row)
                                            <option value="{{$row->id}}">{{$row->item_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Quantity</label>
                                        <input type="number" class="form-control form-control-sm" id="item_qty" min="0">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Item Unit</label>
                                        <select class="form-control form-control-sm" id="item_unit">

                                            <option disabled selected>--Select Unit---</option>
                                            @foreach($units as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" id="add_to_grid" class="btn btn-primary mx-auto">Add To Grid</button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-8 ">
                                <div class="card-header d-flex justify-content-between border">
                                    <div class="header-title">
                                        <h4 class="card-title">Issue To Room Items</h4>
                                    </div>
                                </div>





                                <div class="card border-righ border-bottom border-left p-2 ">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Unit Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_item_issue">
                                            <tr id="itemalert">
                                                <td class="text-center border border-danger pt-4 text-danger" colspan="5">Please add some item!</td>
                                            </tr>
                                            @foreach($itemslist as $key=>$value)

                                            @foreach($value as $row)
                                            @php
                                                $orderid = $row->first()->order_id;
                                            @endphp
                                            <tr class="insertItem">
                                                <th scope="row"><input type="hidden" name="order_id" value="{{$orderid}}"><input type="hidden" name="item_name[]" value="{{$row->first()->item_id}}" /><input type="hidden" name="item_qty[]" value="{{$row->first()->qty}}" /><input type="hidden" name="item_unit[]" value="{{$row->first()->unit_id}}" />{{$orderid}}</th>
                                                <td>{{$row->first()->items->item_name??''}}</td>
                                                <td>{{$row->first()->qty}}</td>


                                                <td>{{$row->first()->unit->name?? ''}}</td>



                                                <td><span onclick="deleteItem(this)" class="deletebtn"><i class="fa fa-trash" aria-hidden="true"></i></span></td>
                                            </tr>
                                            @endforeach


                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                                <div class="card border-righ border-bottom border-left p-2">

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Narration</label>
                                        <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="2" name="remarks">{{$itemIssues->first()->remarks}}</textarea>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-primary mx-auto" id="itemsubmit">Update Items</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#select_room_no').select2();
    });

    $('#itemalert').hide();
</script>


<script>
    var items = document.querySelector('#item_name');
    items.addEventListener('change', (event) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/get/item/section') }}/"+event.target.value,
            
            success: function(data) {
                $('#item_unit').val(data).selected;
            }
        });
    });
</script>



<script>
    var items = (function() {
        function getElement() {
            return {
                itemname: document.querySelector('#item_name'),
                itmeqty: document.querySelector('#item_qty'),
                itemunit: document.querySelector('#item_unit'),
                additem: document.querySelector('#add_item_issue'),
            }
        }



        return {
            element: getElement(),

        }
    })();



    document.querySelector('#add_to_grid').addEventListener('click', function(e) {

        function getAllValue() {
            return {
                itemname: items.element.itemname.selectedOptions[0].innerHTML,
                itemnameid: items.element.itemname.value,
                itmeqty: items.element.itmeqty.value,
                itemunitid: items.element.itemunit.value,
                itemunit: items.element.itemunit.selectedOptions[0].innerHTML,

            }
        }
        if (getAllValue().itmeqty == '' || getAllValue().itmeqty == 0) {
            iziToast.success({
                title: 'Sorry',
                message: 'Quantity Field Must Not be empty!',
                position: 'topCenter'
            });
        } else {
            var html = '<tr class="insertItem"><th scope="row"><input type="hidden" name="order_id" value="{{$orderid}}"><input type="hidden" name="item_name[]" value="%itemnameval%"/><input type="hidden" name="item_qty[]" value="%itemqty%"/><input type="hidden" name="item_unit[]" value="%itemunitval%"/>{{$orderid}}</th><td>%itemname%</td><td>%qty%</td><td>%unitname%</td><td><span onclick="deleteItem(this)" class="deletebtn"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';

            var newhtml = html.replace('%itemname%', getAllValue().itemname);
            var newhtml = newhtml.replace('%qty%', getAllValue().itmeqty);
            var newhtml = newhtml.replace('%unitname%', getAllValue().itemunit);

            var newhtml = newhtml.replace('%itemnameval%', getAllValue().itemnameid);
            var newhtml = newhtml.replace('%itemqty%', getAllValue().itmeqty);
            var newhtml = newhtml.replace('%itemqty%', getAllValue().itmeqty);
            var newhtml = newhtml.replace('%itemunitval%', getAllValue().itemunitid);

            items.element.additem.insertAdjacentHTML('afterend', newhtml);
            $('#itemalert').hide();
        }






    });


    function deleteItem(el) {
        el.closest('.insertItem').remove();
    }
</script>

<script>
    var formdata = document.querySelector('#get_issue_to_room_data');
    var itemsubmit = document.querySelector('#itemsubmit');

    itemsubmit.addEventListener('click', function(e) {
        var insertItem = document.querySelector('.insertItem');
        var issuedate = document.querySelector('#issuedate');
        var select_room_no = document.querySelector('#select_room_no');


        if (insertItem == null) {

            $('#itemalert').show();

        } else if (issuedate.value == '') {
            issuedate.focus();
            document.querySelector('.issue_date').innerHTML = 'Issue Date Can not be null!'

        } else if (select_room_no.value == '') {
            select_room_no.focus();
            document.querySelector('.room_no').innerHTML = 'Please select a Room!'
        } else {
            formdata.submit();
        }


    })
</script>



@endsection