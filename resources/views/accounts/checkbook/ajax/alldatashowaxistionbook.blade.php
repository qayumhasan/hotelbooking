<div class="col-md-12 mt-4">
        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered" style="font-size:12px">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Cheque No:</th>
                        <th>Voucher No</th>
                        <th>Cheque Date</th>
                        <th>Cheque Amount</th>
                        <th>Delevery Date</th>
                        <th>status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($alldata as $key => $data)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$data->check_number}}</td>
                        <td>{{$data->voucher_number}}</td>
                        <td>{{$data->check_date}}</td>
                        <td></td>
                        <td></td>
                        <td>{{$data->status}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>