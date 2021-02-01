<table class="table table-bordered" id="old_data">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Room No</th>
            <th scope="col">User Name</th>
            <th scope="col">Remarks</th>
        </tr>
    </thead>
    <tbody>

        @foreach($itemslists as $key=>$value)
        @foreach($value as $room_id=>$row )
        @php
        $room_no = App\Models\Room::where('id',$room_id)->first();
        @endphp
        <tr @if($loop->first) class="bg-secondary" @else '' @endif>
            @if($loop->first)
            <th scope="row">{{$key}}</th>
            @else
            <th></th>
            @endif

            <th @if($loop->first) ''@else class="bg-light" @endif>{{$room_no->room_no?? ''}}</th>

            <td @if($loop->first) ''@else class="bg-light" @endif>Admin</td>
            <td @if($loop->first) ''@else class="bg-light" @endif>@mdo</td>
        </tr>

        @php
        $total = 0;
        @endphp

        @foreach($row as $data)

        <tr>
            <td></td>
            <td>{{$data->items->item_name?? ''}}</td>
            <td>{{$data->qty}}</td>
            <td>{{$data->unit->name?? ''}}</td>

            @php
            $total = $total + $data->qty;
            @endphp

        </tr>

        @endforeach
        <tr>
            <td></td>
            <th class="text-success">Total</th>
            <td class="text-success" colspan="2">{{$total}}</td>
        </tr>
        @endforeach
        @endforeach


    </tbody>






</table>