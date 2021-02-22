                                    <div class="col-md-12">
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable" class="table data-table table-striped table-bordered" >
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Invoice No</th>
                                                            <th>Item ID</th>
                                                            <th>Item Name</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @php
                                                            $alldata=App\Models\OrderHeadDetails::where('invoice_no',$invoice)->latest()->get();
                                                            $singlecount=App\Models\OrderHeadDetails::where('invoice_no',$invoice)->count();
                                                            $allqty=App\Models\OrderHeadDetails::where('invoice_no',$invoice)->sum('qty');
                                                        @endphp
                                                            @foreach($alldata as $key => $data)
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>{{$data->invoice_no}}</td>
                                                                <td>{{$data->item_id}}</td>
                                                                <td>{{$data->item_name}}</td>
                                                                <td>{{$data->unit}}</td>
                                                                <td>{{$data->qty}}</td>
                                                                <td>
                                                                <!-- <a id="edit" data-id="{{$data->id}}"  class="editcat badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top"  data-original-title="Edit"><i class="lar la-edit"></i></a> -->
                                                                <button type="button" onclick="cartdata(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$data->id}}" data-original-title="Remove"><i class="lar la-edit"></i></button>
                                                                 <button type="button" onclick="cartDatadelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$data->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                       
                                                      
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    