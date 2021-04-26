<table width="100%" style="font-family: sans-serif;" cellpadding="10">
                                <tr>
                                    <td width="100%" style="padding: 0px; text-align: center;">
                                        <a href="#" target="_blank"><img src="{{asset('public/uploads/logo/')}}/{{$logos->logo}}" width="100px" height="25px" alt="Logo" align="center" border="0"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
                                        Voucher
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                                <tr>


                                    <td width="49%" style="border: 0.1mm solid #eee; text-align: left;"><strong>Guest Name: {{$banquet->title}} {{$banquet->guest_name}}</strong>
                                        <br>
                                        <b>Phone: {{$banquet->mobile}} </b>
                                        
                                    </td>
                                    <td width="2%">&nbsp;</td>
                                    <td width="49%" style="border: 0.1mm solid #eee;">

                                        <table width="100%" align="left" style="font-family: sans-serif; font-size: 14px;">

                                        </table>
                                        <table width="100%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Booking No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->booking_no }}</td>
                                            </tr>
                                           
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Invoice Date</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->booking_date }}</td>
                                            </tr> 
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Function Date</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->date_of_function_form }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Function End Date</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->date_of_function_to }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Booking For</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->booking_for }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Total Net Amount</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $banquet->total_net_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Hall/Venue</strong></td>
                                                @php
                                                    $venue=App\Models\Venue::where('id',$banquet->venue_id)->select(['venue_name'])->first();
                                                @endphp
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ $venue->venue_name }}</td>
                                            </tr>


                                        </table>


                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table class="w-100 table-bordered p-4">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                @php
                                    $allitem=App\Models\BanquetItem::where('booking_no',$banquet->booking_no)->get();
                                @endphp
                                <tbody>
                                    @foreach($allitem as $item)
                                    <tr>
                                        <td>{{$item->item_name}}</td>
                                        <td>{{$item->rate}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->amount}}</td>
                                    </tr>
                                   @endforeach
                                  
                                 

                                   

                                </tbody>
                            </table>
                            <table class="w-100 table-bordered p-4" style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th>Tax</th>
                                        <th class="text-center">Calculation</th>
                                        <th class="text-center">Based On</th>
                                        <th class="text-center">Tax rate</th>
                                        <th>Amount</th>
                                        <th>Effect</th>
                                    </tr>
                                </thead>
                                @php
                                    $alltax=App\Models\BanquetTax::where('booking_no',$banquet->booking_no)->get();
                                @endphp
                                <tbody>
                                    @foreach($alltax as $tax)
                                    <tr>
                                        <td>{{$tax->tax_description}}</td>
                                        <td>{{$tax->calculation_on}}</td>
                                        <td>{{$tax->based_on}}</td>
                                        <td>{{$tax->tax_rate}}</td>
                                        <td>{{$tax->tax_amount}}</td>
                                        <td>{{$tax->tax_effect}}</td>
                                    </tr>
                                   @endforeach
                                  
                                 

                                   

                                </tbody>
                            </table>

                            <span>Assign By: </span>

                            <br>
                              <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                                 <br>
                                    <tr>
                                          <td>

                                             <table width="100%" align="left" style="font-family: sans-serif; font-size: 13px; text-align: center;">
                                                <tr>
                                                      <td class="text-center" style="padding: 0px; line-height: 20px;">
                                                         <strong>Company Name</strong>
                                                         <br>
                                                         
                                                         <br>
                                                         Tel:  | Email: 
                                                         <br>
                                                         Company Registered in  Company Reg. 12121212.
                                                         <br>
                                                         VAT Registration No. 021021021 | ATOL No. 1234
                                                      </td>
                                                </tr>
                                             </table>
                                          </td>
                                    </tr>
                                 <br>
                              </table>