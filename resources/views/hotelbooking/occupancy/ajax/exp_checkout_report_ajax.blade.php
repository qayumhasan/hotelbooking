<table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Booking No</th>
                                        <th>Room no</th>
                                        <th>Guest</th>
                                        <th>City</th>
                                        <th>Total Person</th>
                                        <th>In Date</th>
                                        <th>In Time</th>
                                        <th>Exp.Out Date</th>
                                        <th>Exp.Out Time</th>
                                        <th>Room Type</th>
                                        <th>Tariff</th>
                                        <th>Checkin By</th>

                                    </tr>
                                </thead>
                             
                                <tbody class="text-center">
                                @foreach($checkins as $row)
                                    <tr>
                                        <td>{{$row->booking_no}}</td>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->guest_name}}</td>
                                        <td>{{$row->city}}</td>
                                        <td>{{$row->number_of_person}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$row->checkin_time}}</td>
                                        <td>{{$row->exp_checkin_date}}</td>
                                        <td>{{$row->exp_checkin_time}}</td>
                                        <td>{{$row->roomtype->room_type?? ''}}</td>
                                        <td>{{$row->tarif}}</td>
                                        <td>{{$row->user->username}}</td>
                                    </tr>
                                @endforeach
                                </tbody>




                            </table>