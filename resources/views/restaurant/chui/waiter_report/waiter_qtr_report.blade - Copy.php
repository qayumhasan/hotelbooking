@extends('restaurant.chui.master')
@section('title', 'Waiter QTR Reports | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Waiter Sale Performance Current Qtr</h4>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive fast_moving_item">
                            <table class="table table-bordered">
                                @if(count($employees) > 0)
                                <thead>
                                @php
                                    $month = [];
                                  
                                @endphp
                                    <tr>
                                    
                                        <th scope="col">Waiter</th>
                                        @foreach($employees as $key=>$row)
                                        <th scope="col">Total Sale {{$key}}</th>
                                        @php
                                            array_push($month,$key);
                                        @endphp
                                        @endforeach
                                        <th scope="col">Total Qtr.</th>
                                        <th scope="col">% of Total</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                    @foreach($employees as $key=>$row)
                                        @php
                                            $employeeId=App\Models\Emploayee_Sales_Report::whereIn('month_no',[date('n', strtotime('0 month')),date('n', strtotime('-1 month')),date('n', strtotime('-2 month'))])->get();

                                            $employeeId= $employeeId->groupBy('waiter_id');

                                            dd($employeeId);
                                        @endphp
                                        @foreach($employeeId as $emid)
                                            @if($emid->month_name == $key )
                                            <tr>
                                                <td>{{$emid->waiter_id}}</td>
                                                <td>300</td>
                                                <td>400</td>
                                                <td>600</td>
                                                <td>62</td>
                                                <td>00</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                 @endforeach






                                    {{--  @foreach($employees as $key=>$row)
                                        @php
                                        $waiter =$row->groupBy('waiter_id');
                                        @endphp
                                       
                                        @foreach($waiter as $data)
                                         @foreach($data as $item)
                                        <tr>
                                            <th scope="row">{{$item->waiter_id}}</th>

                                            @if($item->month_name == $month[0])
                                            <th scope="row">{{$item->month_name}}</th>
                                            @endif

                                            @if($item->month_name == $month[1])
                                            <th scope="row">{{$item->month_name}}</th>
                                            @endif
                                            
                                            @if($item->month_name == $month[2])
                                            <th scope="row">{{$item->month_name}}</th>
                                            @endif 

                                        </tr>

                                        @endforeach
                                        @endforeach
                                    @endforeach --}}
                                </tbody>
                                @endif
                            </table>





                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection