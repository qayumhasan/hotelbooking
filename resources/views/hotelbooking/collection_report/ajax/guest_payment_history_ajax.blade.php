<table class="table table-bordered">
    <thead>

        <tr>
            <th scope="col">SL</th>
            <th scope="col">Date</th>
            <th scope="col">Guest Name</th>
            <th scope="col">Done By</th>
            <th scope="col">Cash</th>
            <th scope="col">Bank</th>
            <th scope="col">Debt</th>
            <th scope="col">Paid</th>
            <th scope="col">Balance</th>
        </tr>
    </thead>
    <tbody>
    @if(count($checkinguests) > 0)
        @foreach($checkinguests as $row)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$row->checkin_date}}</td>
            <td>{{$row->guest_name}}</td>
            <td>{{$row->admin->username ?? '' }}</td>
            <td>{{$row->cashamount}}</td>
            <td>{{$row->bankamount}}</td>
            <td>{{round($row->checkout->gross_amount ?? '',2)}}</td>
            @php
            $gross_amount = $row->checkout->gross_amount ?? 0 ;
            $paidamount = $row->cashamount + $row->bankamount;
            $balance = $gross_amount - $paidamount;
            @endphp
            <td>{{$paidamount}}</td>
            <td>{{round($balance,2)}}</td>
        </tr>
        @endforeach
    @else
        <tr>
            <th colspan="8" class="text-center">No Data Found!</th>
        </tr>
    @endif
    </tbody>
</table>