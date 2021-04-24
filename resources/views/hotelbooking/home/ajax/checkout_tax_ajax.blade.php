<thead>
    <tr>
        <th class="bg-light" scope="col">Tax Name</th>
        <th class="bg-light" scope="col">Calculation On</th>
        <th class="bg-light" scope="col">Based On</th>
        <th class="bg-light" scope="col">Effect</th>
        <th class="bg-light" width="15%" scope="col">Rate</th>
        <th class="bg-light text-center" width="15%" scope="col">Amount</th>
        <th class="bg-light text-center" scope="col">Action</th>
    </tr>
</thead>
<tbody>

    @if(count($taxs) > 0)
    @foreach($taxs as $row)
    <tr class="delelement">

        <td>{{$row->tax_description_name}}</td>
        <td>{{$row->taxDescription}}</td>
        <td>{{$row->base_on}}</td>
        <td>{{$row->effect}}</td>
        <td>{{$row->rate}}</td>
        <td class="text-center">{{round($row->amount,2)}}</td>
        <td class="text-center">
            <a class="badge bg-primary-light tax_edit mr-2" data-toggle="tooltip" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$row}}"><i class="lar la-edit"></i></a>
            <a class="badge bg-danger-light mr-2 deletetax" data-toggle="tooltip" onclick="delete_row(this)" data-placement="top" data-whatever="{{$row->id}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
        </td>
    </tr>
    @endforeach
    @endif

    <tr>
        <th class="text-right" scope="row" colspan="5">Total Amount</th>
        <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->net_amount,2)}}</th>
    </tr>

    <tr>
        <th class="text-right" scope="row" colspan="5">Discount Amount</th>
        <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->discount_amount,2)}}</th>
    </tr>


    <tr>
        <th class="text-right" scope="row" colspan="5">Net Amount</th>
        <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->gross_amount,2)}}</th>
    </tr>

    @php
    $paybleAmount =$checkout->outstanding_amount;
    @endphp
    <tr>
        <th class="text-right" scope="row" colspan="5">{{$paybleAmount < 0 ?'Refund':'Payable'}}</th>
        <th class="text-center">{!!$currency->symbol ?? ' '!!}
            {{round($paybleAmount,2)}}
        </th>
    </tr>
    <tr>
        <th class="text-right" scope="row" colspan="5">{{$paybleAmount < 0 ?'Refund':'Payable'}} (In Word):</th>
        <td class="text-center">

            <code>{{$numToWord->numberTowords(abs($paybleAmount))}}</code>
        </td>
        <td></td>

    </tr>
</tbody>

<script>
    $(document).ready(function() {
        $('.tax_edit').click(function(e) {
            $('#tax_update').show();
            $('#addToGrid').hide();
            var modal = $(this);
            var data = modal.data('whatever');

            $('#tax_id').val(data.id);
            $('#tax_details').val(data.tax_description_id).selected;
            $('#calculation_on').val(data.calculation_on).selected;
            $('#base_on').val(data.base_on).selected;
            $('#rate').val(data.rate);
            $('#amountActual').val(data.amount);
            $('#amount').val(data.amount);
        });
    })

    $(document).ready(function() {
        $('#tax_update').click(function() {


            var element = $('#invoice_form').serializeArray();

            console.log(element);
            return ;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('admin.checkout.invoice.tax.data.edit')}}",
                data: element,
                success: function(data) {

                    $('#addToGrid').show();
                    $('#tax_update').hide();
                    $('#tax_details_amount').empty();
                    $('#tax_details_amount').append(data);

                },
                error: function(err) {
                    if (err.responseJSON.errors.calculation_on) {
                        $('.calculation_on_alt').html(err.responseJSON.errors.calculation_on[0]);
                    }
                    if (err.responseJSON.errors.tax_details) {
                        $('.tax_details_alt').html(err.responseJSON.errors.tax_details[0]);
                    }
                    if (err.responseJSON.errors.rate) {
                        $('.rate_alt').html(err.responseJSON.errors.rate[0]);
                    }
                }
            });
        })
    });

    function delete_row(em) {

        $(em).closest('.delelement').remove();

        var modal = $(em);
        var data = modal.data('whatever');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: "{{url('admin/checkout/invoice/tax/data/delete')}}/" + data,
            success: function(data) {

                $('#tax_details_amount').empty();
                $('#tax_details_amount').append(data);

            }
        });



    }
</script>