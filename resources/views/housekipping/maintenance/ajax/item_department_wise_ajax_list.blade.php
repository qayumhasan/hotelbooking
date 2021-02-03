<table class="table table-bordered" id="old_data">
    <thead>
        <tr>
            <th scope="col">Room No</th>
            <th scope="col">Date</th>
            <th scope="col">User Name</th>
            <th scope="col">Remarks</th>
        </tr>
    </thead>
    @foreach($itemslists as $key=>$value)

    <tbody>
        <tr>
            <th scope="row" class="bg-light">{{$value->first()->department->name?? ''}}</th>
            <td class="bg-light">{{$value->first()->issue_date}}</td>
            <td class="bg-light">{{$value->first()->issuedby->username?? ''}}</td>
            <td class="bg-light">{{$value->first()->remarks}}</td>
        </tr>
        @php
        $qtycount = 0;
        @endphp
        @foreach($value as $row)

        <tr>
            @if($loop->first)
            <th scope="row">Items - Qty - Unit</th>
            @else
            <th></th>
            @endif
            <td>{{$row->items->item_name?? ''}}</td>
            <td>{{$row->qty}}</td>


            <td>{{$row->unit->name ?? ''}}</td>
            @php
            $qtycount = $qtycount + (int)$row->qty;
            @endphp
        </tr>
        @endforeach

        <tr>
            <th scope="row"></th>
            <th scope="row">Total</th>
            <td colspan="2">{{$qtycount}}</td>
        </tr>
    </tbody>
    @endforeach




</table>