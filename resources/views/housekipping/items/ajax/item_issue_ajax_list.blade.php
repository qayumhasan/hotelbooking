@if(count($itemIssues) > 0)
@foreach($itemIssues as $key=>$row)
<tr class="deleteditem">
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$row->first()->issue_date}}</td>
    <td>{{$row->first()->issuedby->username?? ''}}</td>
    <td>{{$row->first()->remarks?? ''}}</td>

    <td>
        <a href="{{route('admin.housekeeping.distribution.items.issue.list.edit',$key)}}" class="badge bg-primary-light mx-auto editmodal"><i class="lar la-edit"></i></a>
    </td>
</tr>
@endforeach
@else
<tr class="text-center">
    <th colspan="5">No Data Found!</th>
</tr>
@endif