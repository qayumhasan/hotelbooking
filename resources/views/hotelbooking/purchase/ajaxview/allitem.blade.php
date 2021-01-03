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
                                                
                                                      
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Item: </label>
                                                        <input type="text" class="form-control" placeholder="" value="{{ $singlecount }}" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Quantity: </label>
                                                        <input type="text" class="form-control" value="{{$allqty}}" disabled/>
                                                        <input type="hidden" name="num_of_item"  value="{{$singlecount}}"/>
                                                        <input type="hidden" name="num_of_qty"  value="{{$allqty}}"/>
                                                        <input type="hidden" name="invoice_no"  value="{{$invoice}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Remarks: *</label>
                                                        <textarea class="form-control" name="remarks"/></textarea>
                                                        @error('branch_id')
                                                            <div style="color:red">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>