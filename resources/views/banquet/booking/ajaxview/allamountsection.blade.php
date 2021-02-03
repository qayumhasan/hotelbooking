<tr>
                                                                    <td class="style58">
                                                                        <span id="ctl00_ContentPlaceHolder1_Label134" style="font-weight: 700">Pax Amount:</span>
                                                                    </td>
                                                                    <td class="style59">
                                                                        <span style="font-weight: 700; color: #003366;" class="span_total_pax_amount">{{$pax_amount}}</span>
                                                                        <input type="hidden" class="total_pax_amount" name="total_pax_amount" value="{{$pax_amount}}">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="style58">
                                                                        <span id="ctl00_ContentPlaceHolder1_Label135" style="font-weight: 700">Other Items Amount:</span>
                                                                    </td>
                                                                    <td class="style59">
                                                                        <span  style="font-weight: 700; color: #003366;" class="total_other_item_amount">{{$other_item_amount}}</span>
                                                                        <input type="hidden" class="total_other_item_amount" name="total_other_item_amount" value={{$other_item_amount}}>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    @php
                                                                        
                                                                        $alldataamount=$other_item_amount+$pax_amount;

                                                                        foreach($taxamount as $taxalldata){
                                                                            if($taxalldata->tax_effect == 'Add'){
                                                                                $alldataamount += $taxalldata->tax_amount;
                                                                            }else{
                                                                                $alldataamount -=$taxalldata->tax_amount;
                                                                            }
                                                                        }
                                                                    @endphp
                                                               
                                                                    <td class="style58">
                                                                        <span id="ctl00_ContentPlaceHolder1_Label138" style="font-weight: 700">Net Amount:</span>
                                                                    </td>
                                                                    <td class="style59">
                                                                        <span style="font-weight: 700; font-size: medium; color: #003366;" class="total_net_amount">{{$alldataamount}}</span>
                                                                        <input type="hidden" class="total_net_amount" name="total_net_amount" value="{{$alldataamount}}">
                                                                    </td>
                                                                </tr>