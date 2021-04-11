@if(count($texdatas) > 0)
@foreach($texdatas as $row)
<tr class="deleteitem">
    <td scope="row">{{$row->taxdetails->tax_description ?? ''}}</td>

    <td>{{$row->Calculation}}</td>
    <td>{{ucfirst($row->base_on)}}</td>
    <td>{{$row->effect}}</td>
    <td>{{$row->rate}}</td>
    <td>{{round($row->amount,2)}}</td>
    <td>
        <a class="badge bg-primary-light mr-2 editkottaxitem" data-toggle="tooltip" data-placement="top" href="{{route('admin.resturant.kot.tax.edit',$row->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>


        <a class="badge bg-danger-light mr-2 deletekottaxitem" data-toggle="tooltip" data-placement="top" href="{{route('admin.resturant.kot.tax.delete',$row->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>

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
    <td id="discount_amount">{!!$currency->symbol ?? ' '!!} {{round($resgross->discount_amount,2)}}</td>

</tr>


<tr>

    <th colspan="5" class="text-right">Gross Amount</th>
    <td id="gross_amount">{!!$currency->symbol ?? ' '!!} {{round($resgross->gross_amount,2)}}</td>

</tr>


<script>
    $(document).ready(function() {
        $('.editkottaxitem').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url,
                success: function(data) {
                    $('#update').show();
                    console.log($('#addtogridarea').hide())
                    $('#update_tax').val(data.id);
                    $('#tax_discription').val(data.tax_id).selected;
                    $('#calculation_on').val(data.calculation_id).selected;
                    $('#base_on').val(data.base_on).selected;
                    $('#rate').val(data.rate);
                    $('#amountshow').val(data.amount);
                    $('#amounthidden').val(data.amount);

                }
            });
        })
    })


    $(document).ready(function() {
        $('.deletekottaxitem').click(function(e) {
            e.currentTarget.closest('.deleteitem').remove();
            event.preventDefault();
            var url = $(this).attr('href');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url,
                success: function(data) {
                    

                    $('#discount_amount').html(data.discount_amount);
                    $('#gross_amount').html(data.gross_amount);





                }
            });
        })
    })
</script>