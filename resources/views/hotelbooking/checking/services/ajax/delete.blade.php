<style>
    .control-label {
        font-size: 10px;
    }

    .editbtn {
        border: none;
        background: none;
    }
</style>
<div id="deleted_extra_service">
    <div class="row">
        <div class="col-md-12 card basic-drop-shadow shadow-showcase mt-4 p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="control-label" scope="col">Service No</th>
                        <th class="control-label" scope="col">Room No</th>
                        <th class="control-label" scope="col">Services</th>
                        <th class="control-label" scope="col">Services Date</th>
                        <th class="control-label" scope="col">Operator</th>
                        <th class="control-label" scope="col">rate</th>
                        <th class="control-label" scope="col">Qty</th>
                        <th class="control-label" scope="col">Amount</th>
                        <th class="control-label" scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($services) > 0)
                    @foreach($services as $row)

                    <tr>
                    <th scope="row">{{$row->service_no}}</th>
                    <td>{{$row->checkin->room_no ?? ''}}</td>
                    <td>{{$row->services}}</td>
                    <td>{{$row->service_date}}</td>
                    
                    <td>gsdg</td>
                    <td>{{$row->rate}}</td>
                    <td>{{$row->qty}}</td>
                    
                    <td>{{$row->rate*$row->qty}}</td>
                    <td>
                        <button class="editbtn"><a href="{{route('admin.checkin.get.deleted.service',$row->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                    </td>
                </tr>

                    @endforeach
                @else
                    <tr class="text-center">
                        <td>No Services Found!</td>
                    </tr>
                @endif


                </tbody>
            </table>
        </div>
    </div>
</div>