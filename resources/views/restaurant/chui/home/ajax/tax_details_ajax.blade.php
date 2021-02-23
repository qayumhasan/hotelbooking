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
    <td >{{round($resgross->gross_amount,2)}}</td>

</tr>