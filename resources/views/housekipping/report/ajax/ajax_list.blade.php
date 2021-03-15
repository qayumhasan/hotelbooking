<table class="table data-table table-striped table-bordered room_simple_data">
    <thead class="text-center">
        <tr>
            <th>Room</th>
            <th>Room Type</th>
            <th>Status</th>
            <th>Availability</th>
            <th>Last Log</th>
            <th>Log Date</th>
            <th>Name</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @if(count($rooms) > 0)
        @foreach($rooms as $room)

        <tr>
            <td>{{$room->room_no}}</td>
            <td>{{$room->roomtype->room_type?? ''}}</td>
            <td>{{$room->housekeepingreport->keeping_status?? ''}}</td>



            @if($room->room_status == 3)
            <td class="bg_red">Booked</td>
            @elseif($room->room_status == 2)
            <td class="bg-navyblue">House Kepping</td>
            @elseif($room->room_status == 1)
            <td class="bg-green">Available</td>
            @elseif($room->room_status == 4)
            <td class="bg-yellow">Maintenance</td>
            @endif
            <td>{{$room->housekeepingreport->remarks?? ''}}</td>
            <td>{{$room->housekeepingreport->log_date ?? ''}}</td>
            <td>{{$room->housekeepingreport->keeping_name?? ''}}</td>
            <td>
                <a class="badge bg-primary-light mr-2 editmodal" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$room}}"><i class="lar la-edit"></i></a>
            </td>


        </tr>
        @endforeach
        @endif


    </tbody>




</table>





<script>
    $(document).ready(function() {
        $(".editmodal").click(function() {
            
            var modal = $(this)
            var data = modal.data('whatever');
            console.log(data.housekeeping);
            document.getElementById('room_no').innerHTML = data.room_no;
            document.getElementById('room_id').value = data.id;
            document.getElementById('housekeeping_id').value = data.housekeepingreport.id;
            document.getElementById('keeping_date').value = data.housekeepingreport.log_date;
            document.getElementById('keeping_time').value = data.housekeepingreport.log_time;
            document.getElementById('remarks').value = data.housekeepingreport.remarks;
            $('#updatedby').val(data.housekeepingreport.keeping_name).selected;
            $('#status').val(data.housekeepingreport.keeping_status).selected;

        });
    });
</script>