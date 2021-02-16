<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Items</th>
            <th scope="col">Sale Of Qty</th>
            <th scope="col">Rate</th>
            <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
@if(count($firstmovings) > 0)
    @foreach($firstmovings as $row)
        <tr>
            <td>{{$row->item_name}}</td>
            <td>{{$row->no_of_sale}}</td>
            <td>{{$row->rate}}</td>
            @php
                $amount =(float)$row->rate * $row->no_of_sale;
            @endphp
            <td>{{$amount}}</td>
        </tr>
    @endforeach
@else
        <tr>
            <th class="text-center" colspan="5">No Item Found!</th>
        </tr>
@endif

    </tbody>
</table>