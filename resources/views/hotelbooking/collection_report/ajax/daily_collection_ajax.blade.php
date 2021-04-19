<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="row">SL</th>
            <th>Date</th>
            <th>Number</th>
            <th>Guest</th>
            <th>Room</th>
            <th>Mode</th>
            <th>Remarks</th>
            <th>Cashier</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>

    @if(count($vouchers) > 0)
        @foreach($vouchers as $row)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{ \Carbon\Carbon::parse($row->TransectionDate)->format('d/m/Y')}}</td>
            <td>{{$row->voucher_no}}</td>
            <td>{{$row->guest_name}}</td>
            <td>{{$row->room_no}}</td>
            <td>{{$row->voucher_type}}</td>
            <td>{{$row->remarks}}</td>
            <td>{{$row->admin->username ?? '' }}</td>
            <td>{!!$currency->symbol ?? ' '!!} {{abs($row->TransectionAmount)}}</td>    
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="9" class="text-center">No Data Found!</td>
        </tr>
    @endif
    </tbody>
</table>