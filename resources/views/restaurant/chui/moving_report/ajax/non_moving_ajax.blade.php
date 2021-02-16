<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Items</th>
            <th scope="col">Unit</th>
            <th scope="col">Rate</th>
        </tr>
    </thead>
    <tbody>
@if(count($firstmovings) > 0)
    @foreach($firstmovings as $row)
        <tr>
            <td>{{$row->item_name}}</td>
            <td>{{$row->unit->name?? ''}}</td>
            <td>{{$row->rate}}</td>
        </tr>
    @endforeach
@else
        <tr>
            <th class="text-center" colspan="5">No Item Found!</th>
        </tr>
@endif

    </tbody>
</table>