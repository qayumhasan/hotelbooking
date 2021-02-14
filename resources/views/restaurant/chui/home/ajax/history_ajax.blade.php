<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History Of Table No <b><span id="table_no">{{$kotdetailamounts->tableName->table_no ?? ''}}</span></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body printableAreasaveprint">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">KOT Date</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Complementary</th>
                </tr>
            </thead>
            <tbody>
            @if(count($kotdetails) > 0)
                @foreach($kotdetails as $row)

                <tr class="deletehistory">
                    <th scope="row">{{$row->kot_date}}</th>
                    <td>{{$row->item->item_name?? ''}}</td>
                    <td>{{$row->qty}}</td>
                    <td>{{$row->rate}}</td>
                    <td>{{$row->amount}}</td>
                    <td>{{$row->complementitem->item_name??''}}</td>
                <tr>
                
                @endforeach
                <tr class="totalqtyarea">
                    <th scope="row"></th>
                    <th>Total Quentity</th>
                    <td>{{$kotdetailamounts->orderHead->number_of_qty ?? ''}}</td>
                    <th>Total Amount</th>
                    <td>{{$kotdetailamounts->orderHead->total_amount ?? ''}}</td>
                    <td>
                    </td>
                </tr>
            @else
                <tr>
                    <th colspan="5" class="text-center">No Data Found!</th>
                </tr>
            @endif




            </tbody>
            
        </table>
    </div>
    <div class="modal-footer text-center mx-auto">
        <input type="hidden" id="history_table_no" />
        <button type="button" id="historysave" class="btn btn-info">Save</button>
        <button type="button" id="historysaveandprint" class="btn btn-primary savepritbtn">Save & Print</button>
    </div>
</div>