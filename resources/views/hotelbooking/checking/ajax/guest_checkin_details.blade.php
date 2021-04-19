<div class="card shadow-sm shadow-showcase">
    <div class="card-body">
        <h6>Previous History</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Date</th>
                    <th scope="col">Booking Number</th>
                    <th scope="col">Stay</th>
                    <th scope="col">Tariff</th>
                    <th scope="col">Days</th>
                    <th scope="col">Rooms</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Balance</th>
                </tr>
            </thead>
            <tbody>
            @if(count($checkinInfo) > 0)
            @foreach($checkinInfo as $row)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$row->date}}</td>
                    <td>{{$row->booking_no}}</td>
                    <td>{{$row->checkin_date}} -To- {{$row->checkout->checkout_date ?? ''}}</td>
                    <td>{!!$currency->symbol ?? ' '!!} {{round($row->checkout->gross_amount ?? '',2)}}</td>
                    <td>{{$row->additional_room_day}}</td>
                    <td>{{$row->room_no}}</td>
                    <td>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="fas fa-star-half-alt"></i>
                    </td>
                    @php
                        $balance = DB::table('vGuestLedger')->where('GuestID',$row->guest->guest_id)->first();
                    @endphp
                    @if($balance)
                        @if($balance->Balance > 0)
                            <td>{{$balance->TransectionAmount}}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($balance->Balance < 0)
                            <td>{{$balance->TransectionAmount}}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{$balance->TransectionAmount}}</td>
                    @endif
                </tr>
                @endforeach
            @else
                <tr>
                    <th class="text-center" colspan="11">No Data Found!</th>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>