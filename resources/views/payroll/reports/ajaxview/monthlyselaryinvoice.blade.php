                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
                            </div>
                            <div class="col-md-12 text-center">
                               <h4>{{ $companyinformation->company_name }}</h4>
                                <p>{{ $companyinformation->mobile }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p style="padding:5px 0px; background:#000;color:#fff">Authorized Copy </p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p style="padding:5px 0px; background:#f7f7f7;color:#000"></p>
                            </div>
                            <div class="col-md-12 text-left">
                                <h4 style="font-size:12px">Employee Name: {{$data->name}} ({{$data->designation}})</h4>
                                <p style="font-size:11px">Employee ID: {{$data->employee_user_id}} </p>
                            </div>
                            <div class="col-md-6 text-left">
                                <p style="font-size:11px">Date: {{Carbon\Carbon::now()}}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <!-- <p style="font-size:11px">Room No: </p> -->
                            </div>
                            <div class="col-md-12">
                                <table class="table" style="font-size:10px;">
                                    <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Salary</th>
                                        <th>Net Salary</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->year}}</td>
                                            <td>{{$data->salary}}</td>
                                            <td>{{round($data->gross_salary)}}</td>
                                        </tr>
                                      
                                       
                                    </tbody>
                                   
                                </table>
                            </div>
                            <div class="col-md-12 text-right mb=-2">
                                <hr>
                                <p style="font-size:11px">Gross Amount: {{round($data->gross_salary)}}</p>
                            </div>
                           
                            <div class="col-md-6 text-left">
                                <p style="font-size:11px">Author Signature: </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p style="font-size:11px">Employee Signature: </p>
                            </div>
                        </div> 
                        <hr>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
                            </div>
                            <div class="col-md-12 text-center">
                               <h4>{{ $companyinformation->company_name }}</h4>
                                <p>{{ $companyinformation->mobile }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p style="padding:5px 0px; background:#000;color:#fff">Employee Copy </p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p style="padding:5px 0px; background:#f7f7f7;color:#000"></p>
                            </div>
                            <div class="col-md-12 text-left">
                                <h4 style="font-size:12px">Employee Name: {{$data->name}} ({{$data->designation}})</h4>
                                <p style="font-size:11px">Employee ID: {{$data->employee_user_id}} </p>
                            </div>
                            <div class="col-md-6 text-left">
                                <p style="font-size:11px">Date: {{Carbon\Carbon::now()}}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <!-- <p style="font-size:11px">Room No: </p> -->
                            </div>
                            <div class="col-md-12" width="100%">
                                <table class="table" style="font-size:10px;">
                                    <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Mode Of Payment</th>
                                        <th>Salary</th>
                                        <th>Net Salary</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td>{{$data->month}}</td>
                                            <td>{{$data->year}}</td>
                                            <td>{{$data->mode_of_payment}}</td>
                                            <td>{{$data->salary}}</td>
                                            <td>{{round($data->gross_salary)}}</td>
                                        </tr>
                                      
                                       
                                    </tbody>
                                   
                                </table>
                            </div>
                            <div class="col-md-12 text-right mb=-2">
                                <hr>
                                <p style="font-size:11px">Gross Amount: {{round($data->gross_salary)}}</p>
                            </div>
                           
                            <div class="col-md-6 text-left">
                                <p style="font-size:11px">Author Signature: </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p style="font-size:11px">Employee Signature: </p>
                            </div>
                        </div> 