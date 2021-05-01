            <div class="row">
                  <div class="col-md-4">
                     <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="" height="40px">
                     @php
                        $checkno=App\Models\CheckBookTransection::where('id',$data->check_reference)->select(['check_number'])->first();
                     @endphp
                     <h6 style="margin-top:5px;font-size:10px">ChequeNo: <span id="ChequeNo">@if($checkno) {{$checkno->check_number}} @endif</span></h6>
                     
                  </div>
                  <div class="col-md-4">
                     <h3>{{$seo->meta_title}}</h3>
                     <h6>{{$data->voucher_type}}</h6>
                  </div>
                  <div class="col-md-4">
                     <h6 style="margin-top:5px">VoucherNo:<span id="voucherno">{{$data->voucher_no}}</span></h6>
                     <h6>Date:<span class="date">{{$data->date}}</span></h6>
                     <p style="margin-top:2px;font-size:10px">ReferenceChecque:<span id="referenceno">{{$data->check_reference}}</span></p>
                  </div>
                  
                  <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row asif">
                                    <div class="col-md-12 text-left">
                                    Narration: <span id="Narration">{{$data->narration}}</span>
                                    </div>
                                    <div class="col-md-12" style="font-size:12px">
                                     <div class="card" id="">
                                     <div class="card-body">
                                          <table border="1" width="100%">
                                             <thead class="thead-light">
                                                <tr>
                                                   <th scope="col">A/C CODE</th>
                                                   <th scope="col">HeadofAccount</th>
                                                   <th scope="col">Details</th>
                                                   <th scope="col">Dabit</th>
                                                   <th scope="col">Cradit</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                @php
                                                    $total_amount=0;
                                                @endphp
                                                @foreach($alldata as $mafo)
                                                <tr>
                                                   <th scope="row">{{$mafo->account_head_code}}</th>
                                                   <td>{{$mafo->account_head_details}}</td>
                                                   <td>{{$mafo->remarks}}</td>
                                                   <td>{{$mafo->dr_amount}}</td>
                                                   <td>{{$mafo->cr_amount}}</td>
                                                </tr>
                                                @php
                                                    $total_amount=$total_amount + $mafo->dr_amount;
                                                @endphp
                                                @endforeach
                                               
                                             </tbody>
                                          </table>

                                          <!-- <table class="table" border="1">
                                             <tbody>
                                                <tr>
                                                   <td colspan="6">Total: {{$total_amount}}</td>
                                                  
                                                </tr>
                                               
                                             </tbody>
                                          </table> -->
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-12 row" style="margin-bottom:20px;font-size:10px">

                                                <table  width="100%">
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <th scope="row">In Word: ( {{$numToWord->numberTowords($total_amount)}} )</th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td> Total: {{$total_amount}} | {{$total_amount}}</td>
                                                    </tr>
                                                                
                                                    </tbody>
                                                </table>
                                           
                                        </div>
                                    <div class="col-md-12 row">
                                              <table  width="100%" style="font-size:12px">
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <th scope="row">  <span style="border-top:2px solid #000; width:50%;"> PreparedBy:</span></th>
                                                        <td> <span style="border-top:2px solid #000; width:50%;"> CheckedBy:</span></td>
                                                        <td><span style="border-top:2px solid #000; width:50%;"> VerifiedBy:</span></td>
                                                        <td> <span style="border-top:2px solid #000; width:50%;"> ApproveBy:</span></td>
                                                        <td></td>
                                                    </tr>
                                                                
                                                    </tbody>
                                                </table>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
            </div>