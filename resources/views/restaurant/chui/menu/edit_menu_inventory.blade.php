@extends('restaurant.chui.master')
@section('title', 'Menu Inventory | '.$seo->meta_title)
@section('content')

@php
    $orderid = time().rand(11111,99999);
@endphp

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Menu Inventory</h4>
                        </div>
                        <span class="float-right mr-2">
                            <a data-toggle="modal" data-target="#billing" data-whatever="@mdo" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Go To Menu Inventory</span></i>
                            </a>
                        </span>
                    </div>

                    <form action="{{route('admin.restaurant.chui.menu.inventory.update')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div>
                            <div class="modal-body p-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card pl-5 pr-5 m-0 border">
                                            <form>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Finished Goods:</label>
                                                    <select class="form-control form-control-sm" id="fiinished_goods">

                                                        @foreach($categores as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Raw Material:</label>
                                                    <select class="form-control form-control-sm" id="raw_materials">
                                                        <option value="0">--- Select A Items -----</option>
                                                        @foreach($items as $row)
                                                        <option value="{{$row->id}}">{{$row->item_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="text-danger" id="rawalert"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Unit:</label>
                                                    <select class="form-control form-control-sm" id="units">
                                                        <option>---- select Unit ----</option>
                                                    </select>
                                                    <small class="text-danger" id="unitalert"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Qty:</label>
                                                    <input type="number" class="form-control form-control-sm" id="qty">
                                                    <small class="text-danger" id="qtyalert"></small>
                                                </div>
                                                <div class="form-group text-center p-2">
                                                    <button type="button" id="addtogrid" class="btn btn-sm btn-primary mr-auto">Add To Grid</button>
                                                    <button type="button" class="btn btn-sm btn-primary mr-auto update">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>



                                    <div class="col-md-8">
                                        <div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">Unite Name</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="billing_materails">


                                                    @foreach($inventores as $row)
                                                  
                                                    <tr class="delelement" id="delelementedit{{$loop->iteration}}">
                                                        <td>
                                                        <input type="hidden" name="order_id[]" id="orderidedit{{$loop->iteration}}" value="{{$row->order_id}}">
                                                        <input type="hidden" name="finished_goods[]" value="{{$row->fgoods}}" class="fgoodsedit{{$loop->iteration}}">
                                                        <input name="raw_metarials[]" type="hidden" value="{{$row->raw_material}}" class="rgoodsedit{{$loop->iteration}}">
                                                        <input type="hidden" name="units[]" value="{{$row->unit}}" class="ugoodsedit{{$loop->iteration}}">
                                                        <input type="hidden" name="qty[]" value="{{$row->qty}}" class="tqtyedit{{$loop->iteration}}">{{$row->item->item_name ?? ' '}}</td>
                                                        <td>{{$row->unit_item->name ?? ' '}}</td>
                                                        <td>{{$row->qty}}</td>
                                                        <td><a onclick="editrow(this)" id="edit{{$loop->iteration}}" class="badge bg-primary-light mr-2"><i class="lar la-edit"></i></a><a onclick="delete_row(this)" class="badge bg-danger-light mr-2"><i class="la la-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>




                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>






<script>
    $(document).ready(function() {
        $('.update').hide();
        $('#raw_materials').change(function(params) {
            var id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/restaurant/chui/menu/inventory/get/items') }}/" + id,
                dataType: "json",
                success: function(data) {
                    $('#units').empty();
                    $('#units').append('<option value="' + data.unit.id + '">' + data.unit.name + '</option>');
                }
            });
        });
    });
</script>
<script>
    var addtogrit = document.querySelector('#addtogrid');

    var d = new Date();
  
    var order_id = d.getTime()+Math.random(100);

    var items = (function() {

        function getitems() {
            return {
                fgoods: document.querySelector('#fiinished_goods'),
                rowmat: document.querySelector('#raw_materials'),
                units: document.querySelector('#units'),
                qty: document.querySelector('#qty'),
            }
        }

        return {
            items: getitems(),
        }
    })();


    var i = 0;
    addtogrit.addEventListener('click', function(e) {

        function getdata() {
            return {
                fgoodsval: items.items.fgoods.value,
                fgoodshtml: items.items.fgoods.selectedOptions[0].innerHTML,

                rowmatval: items.items.rowmat.value,
                rowmathtml: items.items.rowmat.selectedOptions[0].innerHTML,

                unitsval: items.items.units.value,
                unitshtml: items.items.units.selectedOptions[0].innerHTML,

                qtyval: items.items.qty.value,
            }
        }


        if (getdata().rowmatval == '' || getdata().rowmatval == 0) {

            $('#rawalert').html('Raw Material Field Must not be empty');
            $('#raw_materials').focus();

        } else if (getdata().unitsval == '' || getdata().unitsval == 0) {
            $('#unitalert').html('Unit Field Must not be empty');
            $('#units').focus();


        } else if (getdata().qtyval == '' || getdata().qtyval == 0) {
            $('#qtyalert').html('Quantity Field Must not be empty');
            $('#qty').focus();

        } else {
            var order_id = d.getTime()+Math.random(100);
            var html = '<tr class="delelement" id="delelement' + i + '"><td><input type="hidden" name="order_id[]" value="'+order_id+'"/><input type="hidden" name="finished_goods[]" value="%fgoods%" class="fgoods' + i + '"><input name="raw_metarials[]" type="hidden" value="%rgoods%" class="rgoods' + i + '"><input type="hidden" name="units[]" value="%ugoods%" class="ugoods' + i + '"><input type="hidden" name="qty[]" value="%tqty%" class="tqty' + i + '"> %showitem%</td><td>%showunit%</td><td>%showqty%</td><td><a onclick="editrow(this)" id="' + i + '" class="badge bg-primary-light mr-2"><i class="lar la-edit"></i></a><a onclick="delete_row(this)" class="badge bg-danger-light mr-2"><i class="la la-trash"></i></a></td></tr>';

            var newhtml = html.replace('%fgoods%', getdata().fgoodsval);
            var newhtml = newhtml.replace('%rgoods%', getdata().rowmatval);
            var newhtml = newhtml.replace('%ugoods%', getdata().unitsval);
            var newhtml = newhtml.replace('%tqty%', getdata().qtyval);
            var newhtml = newhtml.replace('%showitem%', getdata().rowmathtml);
            var newhtml = newhtml.replace('%showunit%', getdata().unitshtml);
            var newhtml = newhtml.replace('%showqty%', getdata().qtyval);

            $('#billing_materails').append(newhtml)

            items.items.rowmat.selectedIndex = 0
            items.items.qty.value = 0;

            $('#rawalert').html('');
            $('#unitalert').html('');
            $('#qtyalert').html('');
        }

        i++;

    });

    function delete_row(em) {
        $(em).closest('.delelement').remove();
    }



    function editrow(em) {
        var id = em.id;
        var fgoods = $('.fgoods' + id).val();
        var rgoods = $('.rgoods' + id).val();
        var ugoods = $('.ugoods' + id).val();
        var tqty = $('.tqty' + id).val();

        $('#fiinished_goods').val(fgoods).selected;
        $('#raw_materials').val(rgoods).selected;


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/restaurant/chui/menu/inventory/get/items') }}/" + rgoods,
                dataType: "json",
                success: function(data) {
                    $('#units').empty();
                    $('#units').append('<option value="' + data.unit.id + '">' + data.unit.name + '</option>');
                }
            });

        $('#qty').val(tqty);
        $('.update').show();
        document.querySelector('.update').id = id;
        $('#addtogrid').hide();


    }

    var updateevent = document.querySelector('.update');


    updateevent.addEventListener('click', function(e) {
        var i = updateevent.id;
        
        var order_id = document.querySelector('#orderid'+i).value;
        
        
        function getdata() {
            return {
                fgoodsval: items.items.fgoods.value,
                fgoodshtml: items.items.fgoods.selectedOptions[0].innerHTML,

                rowmatval: items.items.rowmat.value,
                rowmathtml: items.items.rowmat.selectedOptions[0].innerHTML,

                unitsval: items.items.units.value,
                unitshtml: items.items.units.selectedOptions[0].innerHTML,

                qtyval: items.items.qty.value,
            }
        }


        if (getdata().rowmatval == '' || getdata().rowmatval == 0) {

            $('#rawalert').html('Raw Material Field Must not be empty');
            $('#raw_materials').focus();

        } else if (getdata().unitsval == '' || getdata().unitsval == 0) {
            $('#unitalert').html('Unit Field Must not be empty');
            $('#units').focus();


        } else if (getdata().qtyval == '' || getdata().qtyval == 0) {
            $('#qtyalert').html('Quantity Field Must not be empty');
            $('#qty').focus();

        } else {
            
            var html = '<tr class="delelement" id="delelement' + i + '"><td><input type="hidden" name="order_id[]" value="'+order_id+'"/><input type="hidden" name="finished_goods[]" value="%fgoods%" class="fgoods' + i + '"><input name="raw_metarials[]" type="hidden" value="%rgoods%" class="rgoods' + i + '"><input type="hidden" name="units[]" value="%ugoods%" class="ugoods' + i + '"><input type="hidden" name="qty[]" value="%tqty%" class="tqty' + i + '"> %showitem%</td><td>%showunit%</td><td>%showqty%</td><td><a onclick="editrow(this)" id="' + i + '" class="badge bg-primary-light mr-2"><i class="lar la-edit"></i></a><a onclick="delete_row(this)" class="badge bg-danger-light mr-2"><i class="la la-trash"></i></a></td></tr>';

            var newhtml = html.replace('%fgoods%', getdata().fgoodsval);
            var newhtml = newhtml.replace('%rgoods%', getdata().rowmatval);
            var newhtml = newhtml.replace('%ugoods%', getdata().unitsval);
            var newhtml = newhtml.replace('%tqty%', getdata().qtyval);
            var newhtml = newhtml.replace('%showitem%', getdata().rowmathtml);
            var newhtml = newhtml.replace('%showunit%', getdata().unitshtml);
            var newhtml = newhtml.replace('%showqty%', getdata().qtyval);

            $('#billing_materails').append(newhtml)

            items.items.rowmat.selectedIndex = 0
            items.items.qty.value = 0;

            $('#rawalert').html('');
            $('#unitalert').html('');
            $('#qtyalert').html('');
        }

        document.querySelector('#delelement' + i).remove();

        $('.update').hide();
        $('#addtogrid').show();


    });
</script>




@endsection