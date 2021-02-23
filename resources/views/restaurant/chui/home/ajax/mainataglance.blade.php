<div class="col-md-1"></div>
                  <div class="col-md-4">
                     <table>
                        <tr>
                           <td>Table No: {{$table->tableName->table_no}}</td>
                        </tr>
                     
                     </table>
                  </div>
                  <div class="col-md-4">
                     <table>
                        <tr>
                           <td>Date: {{$to}}</td>
                        </tr>
                     </table>
                  </div>
                
                  <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row asif">
                                    <div class="col-md-12">
                                     <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                
                                                   
                                                   <table class="table table-striped table-bordered" >
                                                      <thead class="text-center">
                                                            <tr>
                                                               <th>Kot Date</th>
                                                               <th>Item Name</th>
                                                               <th>Qty</th>
                                                               <th>Rate</th>
                                                               <th>Amount</th>
                                                               <th>Complementory</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody class="text-center">
                                                      @foreach($alldata as $data)
                                                        <tr class="remove_data">
                                                            <td>{{$data->kot_date}}</td>
                                                            <td>{{$data->item->item_name}}</td>
                                                            <td>{{$data->qty}}</td>
                                                            <td>{{$data->rate}}</td>
                                                            <td>{{$data->amount}}</td>
                                                            <td>@if($data->complement == NULL) -- @else {{$data->complement}} @endif</td>
                                                        </tr>
                                                    @endforeach
                                                   
                                                      </tbody>
                                                   </table>
                                                   <!-- <button type="button" class="bt btn-success-sm" id="save" value="save" name="submit">Save</button>
                                                   <button type="button" class="bt btn-success-sm " id="save_print" value="saveandprint" name="submit">Save & Print</button> -->
                                                 
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>