
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Invoice</th>
                                 <th>Tax Name</th>
                                 <th>Calculation on</th>
                                 <th>Based On</th>
                                 <th>Rate</th>
                                 <th>Effect</th>
                                 <th>Amount</th>
                              </tr>
                           </thead>
                           <tbody >
                          @php
                          $finalamount=$amount;
                          @endphp
                           @foreach($alltax as $tax)
                              <tr>
                                 <td>
                                 <button type="button"  onclick="taxedit(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$tax->id}}" data-original-title="Remove"><i class="lar la-edit"></i></button>
                                 <button type="button" onclick="taxDatadelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$tax->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
                                 </td>
                                 <td>{{$invoice}}</td>
                                 <td>{{$tax->tax_descripton}}</td>
                                 <td>{{$tax->calculation}}</td>
                                 <td>{{$tax->based_on}}</td>
                                 <td>{{$tax->rate}}</td>
                                 <td>{{$tax->effect}}</td>
                                 <td>{{round($tax->amount,2)}}</td>
                              
                              </tr>

                                 @if($tax->effect=='Add')
                                    @php
                                       $finalamount=$finalamount+$tax->amount;
                                    @endphp
                                 @else
                                    @php
                                       $finalamount=$finalamount - $tax->amount;
                                    @endphp
                                 @endif
                                
                              @endforeach
                           </tbody>
                           <tfoot class="text-center">
                                    <tr>
                                       <td colspan="7" class="text-right">Net Amount:</td>
                                       <td colspan="2" class="text-left">{{$finalamount}}</td>
                                    </tr>
                            </tfoot>
