<table class="table table-bordered" id="myTable">
  <thead>
  <tr>
            <th scope="col">SL</th>
            <th scope="col">Guest Name</th>
            <th scope="col">City</th>
            <th scope="col">Mobile</th>
            <th scope="col">Balance</th>
            <th scope="col">Select Guest</th>
        </tr>
  </thead>
  <tbody>
  @foreach($guests as $row)
  <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$row->guest_name}}</td>
        <td>{{$row->city}}</td>
        <td>{{$row->mobile}}</td>
        @php
          $balance = DB::table('vGuestLedger')->where('GuestID',$row->guest_id)->first();
        @endphp
        @if($balance)
        <td>{{$balance->Balance}}</td>
        @else
        <td>NULL</td>
        @endif
        <td class="text-center"><button type="button" class="btn btn-sm btn-primary" onclick="getuserData(this)" data-whatever="{{$row}}"><i class="fas fa-check m-0"></i></button></td>
    </tr>
@endforeach

  </tbody>
</table>


<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>