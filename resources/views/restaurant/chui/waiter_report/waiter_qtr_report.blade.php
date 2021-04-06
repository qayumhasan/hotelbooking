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
                                        @foreach($months as $key=>$row)
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
                                  
                                    @foreach($employees as $data)
                                    @php
                                        $monthgroupby = $data->groupBy('month_no');
                                        $groupbyMonth = $monthgroupby->all();
                                    @endphp
                                        <tr>
                                            <td>dsad</td>
                                            @php
                                                $totalinrow = 0;
                                            @endphp
                                            @foreach($groupbyMonth as $row)
                                            <td>{{$row->sum('slae_amount')}}</td>
                                            @php
                                                $totalinrow += $row->sum('slae_amount');
                                            @endphp
                                            @endforeach
                                         
                                            <td>{{$totalinrow}}</td>
                                        </tr>
                                    @endforeach
                                 
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