<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Waiter</th>
            <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>

        @if(count($sales) > 0)
        @foreach($sales as $row)
        <tr>
            <td>{{$row->waiter->employee_name?? ''}}</td>
            <td>{{$row->slae_amount}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <th class="text-center" colspan="2">No Item Found!</th>
        </tr>



        @endif

    </tbody>
</table>